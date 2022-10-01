import 'material-icons/iconfont/material-icons.css';
import 'prism-themes/themes/prism-xonokai.css';
import { Editor, defaultValueCtx, rootCtx } from '@milkdown/core';
import { nord } from '@milkdown/theme-nord';
import { commonmark } from '@milkdown/preset-commonmark';
import { tooltipPlugin, tooltip } from '@milkdown/plugin-tooltip';
import { menu, menuPlugin,SelectParent} from '@milkdown/plugin-menu';
import { diagram } from '@milkdown/plugin-diagram';
import { history } from '@milkdown/plugin-history';
import { setBlockType, wrapIn } from '@milkdown/prose/commands';
import { redo, undo } from '@milkdown/prose/history';
import { liftListItem, sinkListItem } from '@milkdown/prose/schema-list';
import { TextSelection } from '@milkdown/prose/state';
import { prism } from '@milkdown/plugin-prism';
import { slashPlugin, slash, createDropdownItem, defaultActions } from '@milkdown/plugin-slash';
import { block } from '@milkdown/plugin-block';
import { indent, indentPlugin } from '@milkdown/plugin-indent';
import { emoji } from '@milkdown/plugin-emoji';
import { cursor } from '@milkdown/plugin-cursor';
import { math } from '@milkdown/plugin-math';
import { clipboard } from '@milkdown/plugin-clipboard';
import { trailing, trailingPlugin } from '@milkdown/plugin-trailing';
import { listener, listenerCtx } from '@milkdown/plugin-listener';
import {table,gfm,InsertTable } from '@milkdown/preset-gfm';
import { replaceAll, insert, destroy } from '@milkdown/utils';
import Alpine from 'alpinejs';
import Turbolinks from "turbolinks";
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';
import Clipboard from "@ryangjchandler/alpine-clipboard"
const hasMark = (state, type) => {
    if (!type) return false;
    const { from, $from, to, empty } = state.selection;
    if (empty) {
        return !!type.isInSet(state.storedMarks || $from.marks());
    }
    return state.doc.rangeHasMark(from, to, type);
}
// import { TableMap } from '@milkdown/preset-gfm/lib/table/plugin/table-map';
var editor = Editor // <- i was thinking to use this but now i am not  using this for now
    .make()
    .use(nord)
    .use(gfm)
    .use(commonmark)
    .use(listener)
    .use(history)
    .use(prism)
    .use(block)
    .use(emoji)
    .use(table)
    .use(cursor)
    .use(math)
    .use(clipboard)
    .use(menu.configure(menuPlugin, {
        config: [
            [
                {
                    type: 'button',
                    icon: 'undo',
                    key: 'Undo',
                    disabled: (view) => {
                        return !undo(view.state);
                    },
                },
                {
                    type: 'button',
                    icon: 'redo',
                    key: 'Redo',
                    disabled: (view) => {
                        return !redo(view.state);
                    },
                },
            ],
            [
                {
                    type: 'select',
                    text: 'Heading',
                    options: [
                        { id: '1', text: 'Large Heading' },
                        { id: '2', text: 'Medium Heading' },
                        { id: '3', text: 'Small Heading' },
                        { id: '0', text: 'Plain Text' },
                    ],
                    disabled: (view) => {
                        const { state } = view;
                        const heading = state.schema.nodes['heading'];
                        if (!heading) return true;
                        const setToHeading = (level) => setBlockType(heading, { level })(state);
                        return (
                            !(view.state.selection instanceof TextSelection) ||
                            !(setToHeading(1) || setToHeading(2) || setToHeading(3))
                        );
                    },
                    onSelect: (id) => (Number(id) ? ['TurnIntoHeading', Number(id)] : ['TurnIntoText', null]),
                },
            ],
            [
                {
                    type: 'button',
                    icon: 'bold',
                    key: 'ToggleBold',
                    active: (view) => hasMark(view.state, view.state.schema.marks['strong']),
                    disabled: (view) => !view.state.schema.marks['strong'],
                },
                {
                    type: 'button',
                    icon: 'italic',
                    key: 'ToggleItalic',
                    active: (view) => hasMark(view.state, view.state.schema.marks['em']),
                    disabled: (view) => !view.state.schema.marks['em'],
                },
                {
                    type: 'button',
                    icon: 'strikeThrough',
                    key: 'ToggleStrikeThrough',
                    active: (view) => hasMark(view.state, view.state.schema.marks['strike_through']),
                    disabled: (view) => !view.state.schema.marks['strike_through'],
                },
            ],
            [
                {
                    type: 'button',
                    icon: 'bulletList',
                    key: 'WrapInBulletList',
                    disabled: (view) => {
                        const { state } = view;
                        const node = state.schema.nodes['bullet_list'];
                        if (!node) return true;
                        return !wrapIn(node)(state);
                    },
                },
                {
                    type: 'button',
                    icon: 'orderedList',
                    key: 'WrapInOrderedList',
                    disabled: (view) => {
                        const { state } = view;
                        const node = state.schema.nodes['ordered_list'];
                        if (!node) return true;
                        return !wrapIn(node)(state);
                    },
                },
                {
                    type: 'button',
                    icon: 'taskList',
                    key: 'TurnIntoTaskList',
                    disabled: (view) => {
                        const { state } = view;
                        const node = state.schema.nodes['task_list_item'];
                        if (!node) return true;
                        return !wrapIn(node)(state);
                    },
                },
                {
                    type: 'button',
                    icon: 'liftList',
                    key: 'LiftListItem',
                    disabled: (view) => {
                        const { state } = view;
                        const node = state.schema.nodes['list_item'];
                        if (!node) return true;
                        return !liftListItem(node)(state);
                    },
                },
                {
                    type: 'button',
                    icon: 'sinkList',
                    key: 'SinkListItem',
                    disabled: (view) => {
                        const { state } = view;
                        const node = state.schema.nodes['list_item'];
                        if (!node) return true;
                        return !sinkListItem(node)(state);
                    },
                },
            ],
            [
                {
                    type: 'button',
                    icon: 'link',
                    key: 'ToggleLink',
                    active: (view) => hasMark(view.state, view.state.schema.marks['link']),
                },
                {
                    type: 'button',
                    icon: 'image',
                    key: 'InsertImage',
                },
                {
                    type: 'button',
                    icon: 'table',
                    key: InsertTable ,
                },
                {
                    type: 'button',
                    icon: 'code',
                    key: 'TurnIntoCodeFence',
                },
            ],
            [
                {
                    type: 'button',
                    icon: 'quote',
                    key: 'WrapInBlockquote',
                },
                {
                    type: 'button',
                    icon: 'divider',
                    key: 'InsertHr',
                },
                {
                    type: 'button',
                    icon: 'select',
                    key:  SelectParent,
                },
            ]
        ],
    }))
    .use(
        trailing.configure(trailingPlugin, {
            shouldAppend: (lastNode, state) => lastNode && !['paragraph'].includes(lastNode.type
                .name),
        })
    )
    .use(
        tooltip.configure(tooltipPlugin, {
            top: true,
        }))
    .use(
        slash.configure(slashPlugin, {
            config: (ctx) => {
                // Get default slash plugin items
                const actions = defaultActions(ctx);

                // Define a status builder
                return ({
                    isTopLevel,
                    content,
                    parentNode
                }) => {
                    // You can only show something at root level
                    if (!isTopLevel) return null;

                    // Empty content ? Set your custom empty placeholder !
                    if (!content) {
                        return {
                            placeholder: 'Type / to use the slash commands...'
                        };
                    }

                    // Define the placeholder & actions (dropdown items) you want to display depending on content
                    if (content.startsWith('/')) {
                        // Add some actions depending on your content's parent node
                        if (parentNode.type.name === 'customNode') {
                            actions.push({
                                id: 'custom',
                                dom: createDropdownItem(ctx.get(themeToolCtx),
                                    'Custom',
                                    'h1'),
                                command: () => ctx.get(commandsCtx)
                                    .call( /* Add custom command here */),
                                keyword: ['custom'],
                                enable: () => true,
                            });
                        }

                        return content === '/' ? {
                            placeholder: 'Type to filter...',
                            actions,
                        } : {
                            actions: actions.filter(({
                                keyword
                            }) =>
                                keyword.some((key) => key.includes(content.slice(1)
                                    .toLocaleLowerCase())),
                            ),
                        };
                    }
                };
            },
        }),
    )
    .use(
        indent.configure(indentPlugin, {
            type: 'space', // available values: 'tab', 'space',
            size: 4,
        }),
    )
    .use(diagram);

window.milkdown = {
    Editor, defaultValueCtx, rootCtx, nord, tooltipPlugin, tooltip, commonmark, menu, diagram, history
    , prism, slashPlugin, slash, createDropdownItem, defaultActions, block, emoji, cursor, math, clipboard, trailing, trailingPlugin, listener, listenerCtx,
    indent, indentPlugin, table, replaceAll, insert, destroy, editor,gfm
}

Alpine.plugin(Clipboard);
Alpine.plugin(focus);
Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();
Turbolinks.start();



