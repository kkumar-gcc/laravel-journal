import 'material-icons/iconfont/material-icons.css';
// import 'prism-themes/themes/prism-duotone-sea.css';
import { Editor, defaultValueCtx, rootCtx } from '@milkdown/core';
import { nord } from '@milkdown/theme-nord';
import { commonmark } from '@milkdown/preset-commonmark';
import { tooltipPlugin, tooltip } from '@milkdown/plugin-tooltip';
import { menu } from '@milkdown/plugin-menu';
import { diagram } from '@milkdown/plugin-diagram';
import { history } from '@milkdown/plugin-history';
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
import { SupportedKeys, table, InsertTable } from '@milkdown/preset-gfm';
// Don't forget to import the style of katex!
// import 'katex/dist/katex.min.css';



import Alpine from 'alpinejs';
import Turbolinks from "turbolinks";
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';
import Clipboard from "@ryangjchandler/alpine-clipboard"
const defaultValue = {
    type: 'html',
    dom: document.querySelector('#editor'),
};

window.milkdown = {
    Editor, defaultValueCtx, rootCtx, nord, tooltipPlugin, tooltip, commonmark, menu, diagram, history
    , prism, slashPlugin, slash, createDropdownItem, defaultActions, block, emoji, cursor, math, clipboard, trailing, trailingPlugin, listener, listenerCtx, SupportedKeys, table, InsertTable,
    defaultValue, indent, indentPlugin
}

Alpine.plugin(Clipboard);
Alpine.plugin(focus);
Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();
Turbolinks.start();



