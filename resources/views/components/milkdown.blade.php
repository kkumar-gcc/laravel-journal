<div wire:ignore>
    <div class="milkdown-container space-y-4">
        <div class="milkdownEditor relative">
            <div class="default">
                {{ $slot }}
            </div>
        </div>
        <button class="clear-button" type="button">Clear</button>
    </div>

    {{--
        Use `@once` to run php code block only once
        This will allow us to push script confidently without duplications
        https://laravel.com/docs/9.x/blade#the-once-directive

        Using `data-turbolinks-eval="false"` prevents evaluating script for subsequent turbolinks visits
        We can also take advantage of `turbolinks:load` event because of this
        https://github.com/turbolinks/turbolinks#working-with-script-elements

        We are expecting to use many instance of milkdown on a single page so we won't use
        any id for each one, instead we define a single class and iterate through them every time
        we visit a link via `turbolinks:load`.

        This way we don't need to worry about the context of each milkdown component
    --}}
    @once
        @push('scripts')
            <script data-turbolinks-eval="false">
                document.addEventListener('turbolinks:load', function() {
                    document.querySelectorAll('.milkdown-container').forEach(async (element) => {
                        const milkdownWrapper = element.querySelector('.milkdownEditor .milkdown-menu-wrapper');
                        if (milkdownWrapper) {
                            milkdownWrapper.parentNode.innerHTML = '';
                        }
                        const defaultValue = {
                            type: 'html',
                            dom: element.querySelector('.default'),
                        };
                        const editor = await milkdown.Editor
                            .make()
                            .config((ctx) => {
                                ctx.get(milkdown.listenerCtx)
                                    .markdownUpdated((ctx, markdown, prevMarkdown) => {
                                        @this.set('body', markdown);
                                    })
                                ctx.set(milkdown.defaultValueCtx, defaultValue);
                                ctx.set(milkdown.rootCtx, document.querySelector('.milkdownEditor'));
                            })
                            .use(milkdown.nord)
                            .use(milkdown.listener)
                            .use(milkdown.history)
                            .use(milkdown.emoji)
                            .use(milkdown.gfm)
                            .use(milkdown.cursor)
                            .use(milkdown.math)
                            .use(milkdown.clipboard)
                            .use(milkdown.menu)
                            .use(milkdown.prism)
                            .use(
                                milkdown.trailing.configure(milkdown.trailingPlugin, {
                                    shouldAppend: (lastNode, state) => lastNode && !['paragraph'].includes(
                                        lastNode
                                        .type.name),
                                })
                            )
                            .use(
                                milkdown.tooltip.configure(milkdown.tooltipPlugin, {
                                    top: true,
                                }))
                            .use(
                                milkdown.slash.configure(milkdown.slashPlugin, {
                                    config: (ctx) => {
                                        // Get default slash plugin items
                                        const actions = milkdown.defaultActions(ctx);
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
                                                        dom: createDropdownItem(ctx.get(
                                                                themeToolCtx), 'Custom',
                                                            'h1'),
                                                        command: () => ctx.get(commandsCtx)
                                                            .call( /* Add custom command here */ ),
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
                                                        keyword.some((key) => key.includes(
                                                            content
                                                            .slice(1)
                                                            .toLocaleLowerCase())),
                                                    ),
                                                };
                                            }
                                        };
                                    },
                                }),
                            )
                            .use(
                                milkdown.indent.configure(milkdown.indentPlugin, {
                                    type: 'space', // available values: 'tab', 'space',
                                    size: 4,
                                }),
                            )
                            .use(milkdown.diagram)
                            .create()
                        // Sample action for each component
                        element.querySelector('.clear-button').addEventListener('click', () => {
                            editor.action(milkdown.replaceAll(''))
                        })
                    })
                })
            </script>
        @endpush
    @endonce
</div>
