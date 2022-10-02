<script data-turbolinks-eval="false">
    /**
     * Always import this script inside layouts
     */
    function initializeMilkdown() {
        document.querySelectorAll('.milkdown-container').forEach(async (element) => {
            const milkdownWrapper = element.querySelector('.milkdownEditor .milkdown-menu-wrapper');
            if (milkdownWrapper) {
                milkdownWrapper.parentNode.innerHTML = '';
            }

            /**
             * Turbolinks messes up livewire, php is never called when turbolinks navigate
             * so slot will always be empty, using slot is not possible because of this
             */
            // const defaultValue = {
            //     type: 'html',
            //     dom: element.querySelector('.default'),
            // };

            const editor = await milkdown.Editor
                .make()
                .config((ctx) => {
                    ctx.get(milkdown.listenerCtx)
                        .markdownUpdated((ctx, markdown, prevMarkdown) => {
                            // {{-- @this.set('body', markdown); --}}
                        })
                    // Do a fetch request here to get markdown
                    // Sample
                    // const markdown = axios.get(url-to-resource)
                    // if(markdown) {
                    //     ctx.set(milkdown.defaultValueCtx, markdown);
                    // }
                    ctx.set(milkdown.rootCtx, element.querySelector('.milkdownEditor'));
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
                .use(milkdown.slash
                    // .configure(milkdown.slashPlugin, {
                    //     config: (ctx) => {
                    //         // Get default slash plugin items
                    //         const actions = milkdown.defaultActions(ctx);

                    //         // Define a status builder
                    //         return ({ isTopLevel, content, parentNode }) => {
                    //             // You can only show something at root level
                    //             if (!isTopLevel) return null;

                    //             // Empty content ? Set your custom empty placeholder !
                    //             if (!content) {
                    //                 return {
                    //                     placeholder: 'Type / to use the slash commands...'
                    //                 };
                    //             }

                    //             // Define the placeholder & actions (dropdown items) you want to display depending on content
                    //             if (content.startsWith('/')) {
                    //                 // Add some actions depending on your content's parent node
                    //                 if (parentNode.type.name === 'customNode') {
                    //                     actions.push({
                    //                         id: 'custom',
                    //                         dom: createDropdownItem(ctx.get(
                    //                             themeManagerCtx), 'Custom',
                    //                             'h1'),
                    //                         command: () => ctx.get(commandsCtx)
                    //                             .call( /* Add custom command here */ ),
                    //                         keyword: ['custom'],
                    //                         enable: () => true,
                    //                     });
                    //                 }

                    //                 return content === '/' ? {
                    //                     placeholder: 'Type to filter...',
                    //                     actions,
                    //                 } : {
                    //                     actions: actions.filter(({ keyword }) =>
                    //                         keyword.some((key) => {
                    //                             key.includes(content.slice(1).toLocaleLowerCase())
                    //                         }),
                    //                     ),
                    //                 };
                    //             }
                    //         };
                    //     },
                    // }),
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
    }

    /**
     * Listening to livewire:load only works if script is injected on a livewire component
     * so we cannot directly put this inside layouts since {{-- @this --}} will cause an error
     * 
     * If we put this inside a livewire component we risk running the scripts twice since we
     * also listen for turbolinks:load
     * 
     * IMO there are so many drawbacks in using turbolinks more than the benefits it gives
     */
    document.addEventListener('livewire:load', function() {
        // {{-- console.log(@this) --}}
    })

    document.addEventListener('turbolinks:load', function() {
        console.log('Initializing milkdown')
        initializeMilkdown()
    })
</script>