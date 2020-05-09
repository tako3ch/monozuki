// blogcard用js

// ひとことメモ
(function (blocks, editor, i18n, element) {
    var el = element.createElement;
    var __ = i18n.__;
    var RichText = editor.RichText;
    blocks.registerBlockType("hks-orgblock/memo-block", {
        title: __("ちょこっとメモ", "chokotto-memo"),
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
    //
    blocks.registerBlockType("hks-orgblock/txtbox-block", {
        title: __("シンプルなボックス", "simple-txtbox"),
        icon: "carrot",
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
                className: "txtbox-block",
                value: props.attributes.content,
            });
        },
    });
    // camera
    blocks.registerBlockType("hks-orgblock/camerabox-block", {
        title: __("カメラアイコン", "simple-camerabox"),
        icon: "camera",
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
                className: "camerabox-block",
                value: props.attributes.content,
            });
        },
    });

    // book
    blocks.registerBlockType("hks-orgblock/bookbox-block", {
        title: __("本アイコン", "simple-bookbox"),
        icon: "book",
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
                className: "bookbox-block",
                value: props.attributes.content,
            });
        },
    });
})(window.wp.blocks, window.wp.editor, window.wp.i18n, window.wp.element);

(function (blocks, editor, i18n, element, components, _) {
    var el = element.createElement;
    var RichText = editor.RichText;
    var MediaUpload = editor.MediaUpload;

    blocks.registerBlockType("hks-orgblock/sectioncard-block", {
        title: i18n.__("連動ブロック", "midashi-card"),
        icon: "index-card",
        category: "mnzk_orgblock",
        attributes: {
            mediaID: {
                type: "number",
            },
            mediaURL: {
                type: "string",
                source: "attribute",
                selector: "img",
                attribute: "src",
            },
            title: {
                type: "array",
                source: "children",
                selector: "p",
            },
        },
        edit: function (props) {
            var attributes = props.attributes;
            var onSelectImage = function (media) {
                return props.setAttributes({
                    mediaURL: media.url,
                    mediaID: media.id,
                });
            };

            return el(
                "div",
                { className: props.className },
                el(
                    "div",
                    { className: "sectioncard" },
                    el(MediaUpload, {
                        onSelect: onSelectImage,
                        allowedTypes: "image",
                        value: attributes.mediaID,
                        render: function (obj) {
                            return el(
                                components.Button,
                                {
                                    className: attributes.mediaID
                                        ? "image-button"
                                        : "button button-large",
                                    onClick: obj.open,
                                },
                                !attributes.mediaID
                                    ? i18n.__(
                                          "Upload Image",
                                          "sectioncard-block"
                                      )
                                    : el("img", { src: attributes.mediaURL })
                            );
                        },
                    })
                ),
                el(RichText, {
                    tagName: "p",
                    inline: true,
                    placeholder: i18n.__("テキストエリア", "sectioncard-block"),
                    value: attributes.title,
                    onChange: function (value) {
                        props.setAttributes({ title: value });
                    },
                })
            );
        },
        save: function (props) {
            var attributes = props.attributes;
            return el(
                "div",
                { className: props.className },
                attributes.mediaURL &&
                    el(
                        "div",
                        { className: "sectioncard-image" },
                        el("img", { src: attributes.mediaURL })
                    ),
                el(RichText.Content, {
                    tagName: "p",
                    value: attributes.title,
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

(function (blocks, editor, i18n, element, components, _) {
    var el = element.createElement;
    var RichText = editor.RichText;

    blocks.registerBlockType("hks-orgblock/txtbox2-block", {
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
