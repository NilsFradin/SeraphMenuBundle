$("#table-tree").tableDrag(
    {
        // General options.
        // The <tr> class indicating that it's draggable.
        draggableClass: 'draggable',
        // The path for the cookie flag. A link is displayed which allows users
        // to switch between the drag and drop interface or the "plain" interface.
        cookiePath: '/',
        // Specific options.
        // The weight option allows elements to be sorted.
        // Pass a "falsy" value to fieldClass to deactivate (false, null, undefined, etc).
        weight: {
            // The class of the <select> list. Weights will be deduced by the <option>s in this list.
            // <option> values should be integers.
            fieldClass: 'item-position',
            // Hides the <select>s parent <td> for better usability.
            hidden: true
        },
        // The parent option allows elements to be children of one another.
        // Pass a "falsy" value to fieldClass to deactivate.
        // To allow the child-parent relationship to function correctly, each row must contain an input
        // with the class defined in sourceFieldClass wich represents the current row.
        // This can be a hidden input.
        parent: {
            // The class of the field containing the "parent" id. Can be any form item.
            fieldClass: 'item-parent',
            // The class of the field containing the current "row" id. Can be any form item.
            sourceFieldClass: 'item-id',
            // Hides the parent <td> of the "parent" field for better usability.
            hidden: true
        },
        // The group option allows elements to be dragged with their children as a whole.
        // This is usually what you want.
        // It's related to parent and can only function with it.
        // Pass a "falsy" value to fieldClass to deactivate.
        group: {
            // The class of the field containing the row "depth". Can be any form item.
            fieldClass: 'item-depth',
            // The depth limit to which items can be nested and dragged as a group.
            depthLimit: 3
        }
    }
);
var submit_button = $("#fake_submit");
$(document).bind('tabledrag:droprow', function() {
    submit_button.removeClass("btn-outline-gray-600");
    submit_button.addClass("btn-outline-success");
});
submit_button.click(function() {
    $("form#organize").submit();
});