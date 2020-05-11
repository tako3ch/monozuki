// blogcard用js

// ひとことメモ
(function (blocks, editor, i18n, element) {
    var el = element.createElement;
    var __ = i18n.__;
    var RichText = editor.RichText;
    blocks.registerBlockType("mnzkblk/memo-block", {
        title: __("ボーダー付きボックス", "memo-block"),
        icon: "lightbulb",
        category: "mnzk_orgblock",
        attributes: {
            content: {
                type: "array",
                source: "children",
                selector: "p",
            },
        },
        edit: function (props) {
            var content = props.attributes.content;
            function onChangeContent(newContent) {
                props.setAttributes({ content: newContent });
            }
            return el(RichText, {
                tagName: "p",
                className: props.className,
                onChange: onChangeContent,
                value: content,
            });
        },

        save: function (props) {
            return el(RichText.Content, {
                tagName: "p",
                className: "memo-block",
                value: props.attributes.content,
            });
        },
    });
})(window.wp.blocks, window.wp.editor, window.wp.i18n, window.wp.element);

(function (blocks, editor, i18n, element, components, _) {
    var el = element.createElement;
    var RichText = editor.RichText;

    blocks.registerBlockType("mnzkblk/txtbox2-block", {
        title: i18n.__("見出しBOX", "midashi-box"),
        icon: "paperclip",
        category: "mnzk_orgblock",
        attributes: {
            title: {
                type: "array",
                source: "children",
                selector: "p",
            },
            innertxt: {
                type: "array",
                source: "children",
                selector: ".innertxt",
            },
        },
        edit: function (props) {
            var attributes = props.attributes;
            return el(
                "div",
                { className: props.className },
                el(RichText, {
                    tagName: "p",
                    inline: true,
                    placeholder: i18n.__("Memo", "txtbox2-block"),
                    value: attributes.title,
                    onChange: function (value) {
                        props.setAttributes({ title: value });
                    },
                }),
                el(RichText, {
                    tagName: "p",
                    inline: false,
                    placeholder: i18n.__("innertxt…", "txtbox2-block"),
                    value: attributes.innertxt,
                    onChange: function (value) {
                        props.setAttributes({ innertxt: value });
                    },
                })
            );
        },
        save: function (props) {
            var attributes = props.attributes;

            return el(
                "div",
                { className: props.className },
                el(RichText.Content, {
                    tagName: "p",
                    className: "innerttl",
                    value: attributes.title,
                }),
                el(RichText.Content, {
                    tagName: "div",
                    className: "innertxt",
                    value: attributes.innertxt,
                })
            );
        },
    });
})(
    window.wp.blocks,
    window.wp.editor,
    window.wp.i18n,
    window.wp.element,
    window.wp.components,
    window._
);
