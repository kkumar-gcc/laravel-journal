import Alpine from 'alpinejs';
import Turbolinks from "turbolinks";
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';
import Clipboard from "@ryangjchandler/alpine-clipboard"
//editor js
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/list';
import LinkTool from '@editorjs/link';
import RawTool from '@editorjs/raw';
import SimpleImage from "@editorjs/simple-image";
import Checklist from "@editorjs/checklist";
import List from '@editorjs/list';
import Embed from '@editorjs/embed';
import Quote  from '@editorjs/quote';

Alpine.plugin(Clipboard);
Alpine.plugin(focus);
Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();
Turbolinks.start();


//Editor Js
const editor = new EditorJS({
    holder: 'editorjs',
    tools: {
        header: Header,
        linkTool: {
            class: LinkTool,
            config: {
                endpoint: 'http://localhost:8008/fetchUrl', // Your backend endpoint for url data fetching,
            }
        },
        raw: RawTool,
        image: SimpleImage,
        checklist: {
            class: Checklist,
            inlineToolbar: true,
        },
        list: {
            class: List,
            inlineToolbar: true,
        },
        embed: {
            class: Embed,
            config: {
                services: {
                    youtube: true,
                    coub: true
                }
            }
        },
        quote:Quote,
    },
    placeholder: 'Let`s write an awesome story!',
});

