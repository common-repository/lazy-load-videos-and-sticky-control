(function() {
    // Define the edit mode component for your block
    const EditComponent = ({ attributes, setAttributes }) => {
        const { position, id } = attributes;

        // Function to handle changes in attributes
        const onChangePosition = (newPosition) => {
            setAttributes({ position: newPosition });
        };

        const onChangeId = (newId) => {
            setAttributes({ id: newId });
        };

        // Return the edit form
        return wp.element.createElement(
            'div',
            null,
            wp.element.createElement(
                InspectorControls,
                null,
                wp.element.createElement(TextControl, {
                    label: 'Position',
                    value: position,
                    onChange: onChangePosition,
                }),
                wp.element.createElement(TextControl, {
                    label: 'Video ID',
                    value: id,
                    onChange: onChangeId,
                })
            )
        );
    };

    // Register the block type
    wp.blocks.registerBlockType('lazy-load-videos-and-sticky-control/llvasc-block', {
        title: 'LLVASC Block',
        category: 'llvasc-category',
        attributes: {
            position: {
                type: 'string',
                default: 'stick-to-bottom-right',
            },
            id: {
                type: 'string',
                default: '',
            },
        },
        edit: EditComponent,
        save: () => null, // Save function is not needed in this case
    });
})();
