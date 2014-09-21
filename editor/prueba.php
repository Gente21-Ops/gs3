
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>GoSchool</title>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript" src="js/plugins/forms/ui.spinner.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.mousewheel.js"></script>
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<!-- DATATABLES -->
<link href="css/dataTables.editor.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="js/plugins/tables/jquery.dataTables.js" ></script>
<script type="text/javascript" charset="utf-8" src="js/plugins/tables/dataTables.editor.js" ></script>
<!-- DATATABLES -->


<style type="text/css">
            @import "../../media/css/jquery.dataTables.css";
            @import "../css/dataTables.editor.css";
         
    #container {
        padding-top: 60px !important;
        width: 960px !important;
    }
    #dt_example .big {
        font-size: 1.3em;
        line-height: 1.45em;
        color: #111;
        margin-left: -10px;
        margin-right: -10px;
        font-weight: normal;
    }
    #dt_example {
        font: 95%/1.45em "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
        color: #111;
    }
    div.dataTables_wrapper, table {
        font: 13px/1.45em "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
    }
    #dt_example h1 {
        font-size: 16px !important;
        color: #111;
    }
    #footer {
        line-height: 1.45em;
    }
    div.examples {
        padding-top: 1em !important;
    }
    div.examples ul {
        padding-top: 1em !important;
        padding-left: 1em !important;
        color: #111;
    }
</style>
<script type="text/javascript" charset="utf-8" src="../js/plugins/tables/jquery.dataTables.js" ></script>
<script type="text/javascript" charset="utf-8" src="../js/plugins/tables/dataTables.editor.js" ></script>


<script type="text/javascript">
var editor; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function() {
    // Create the form
    editor = new $.fn.dataTable.Editor( {
        "ajaxUrl": "php/browsers.php",
        "domTable": "#example",
        "fields": [ {
                "label": "Browser:",
                "name": "browser"
            }, {
                "label": "Rendering engine:",
                "name": "engine"
            }, {
                "label": "Platform:",
                "name": "platform"
            }, {
                "label": "Version:",
                "name": "version"
            }, {
                "label": "CSS grade:",
                "name": "grade"
            }
        ]
    } );
 
    // New record
    $('a.editor_create').on('click', function (e) {
        e.preventDefault();
 
        editor.create(
            'Create new record',
            { "label": "Add", "fn": function () { editor.submit() } }
        );
    } );
 
    // Edit record
    $('#example').on('click', 'a.editor_edit', function (e) {
        e.preventDefault();
 
        editor.edit(
            $(this).parents('tr')[0],
            'Edit record',
            { "label": "Update", "fn": function () { editor.submit() } }
        );
    } );
 
    // Delete a record (without asking a user for confirmation)
    $('#example').on('click', 'a.editor_remove', function (e) {
        e.preventDefault();
 
        editor.remove( $(this).parents('tr')[0], '123', false, false );
        editor.submit();
    } );
 
    // DataTables init
    $('#example').dataTable( {
        "sDom": "Tfrtip",
        "sAjaxSource": "php/browsers.php",
        "aoColumns": [
            { "mData": "browser" },
            { "mData": "engine" },
            { "mData": "platform" },
            { "mData": "grade", "sClass": "center" },
            {
                "mData": null,
                "sClass": "center",
                "sDefaultContent": '<a href="" class="editor_edit">Edit</a> / <a href="" class="editor_remove">Delete</a>'
            }
        ]
    } );
} );
</script>

</head>

<body>


<a href="" class="editor_create">Create new record</a>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
    <thead>
        <tr>
            <th width="30%">Browser</th>
            <th width="20%">Rendering engine</th>
            <th width="20%">Platform(s)</th>
            <th width="14%">CSS grade</th>
            <th width="16%">Admin</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Browser</th>
            <th>Rendering engine</th>
            <th>Platform(s)</th>
            <th>CSS grade</th>
            <th>Admin</th>
        </tr>
    </tfoot>
</table>




</body>
</html>
