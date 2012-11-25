<!doctype html>
<html data-ng-app="Application">
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="assets/css/grid.css" />
    </head>
    <body>

        <div data-ng-controller="TypeController" style="border: 2px black dotted;">
            <div data-ng-include="view()"></div>
        </div>

        <script type="text/ng-template" id="type/query">
            <div><a data-ng-click="query()">List</a></div>
            <div><a data-ng-click="create()">Create</a></div>
            <h2>Types</h2>
            <ul>
                <li data-ng-repeat="type in types"
                    data-ng-click="read(type.name)">
                    {{type.name}}
                </li>
            </ul>
        </script>

        <script type="text/ng-template" id="type/read">
            <div><a data-ng-click="query()">List</a></div>
            <div><a data-ng-click="create()">Create</a></div>
            <h2>Type: {{type.name}} [<a data-ng-click="update(type.name)">Update</a>]</h2>
            <table>
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Field</th>
                        <th>Input</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-ng-repeat="field in type.fields">
                        <td>{{field.label}}</td>
                        <td>{{field.name}}</td>
                        <td>{{field.input}}</td>
                        <td>{{field.type}}</td>
                    </tr>
                </tbody>
            </table>
            <div><button data-ng-click="remove(type.name)">Delete</button></div>
        </script>

        <script type="text/ng-template" id="type/edit">
            <div><a data-ng-click="query()">List</a></div>
            <div><a data-ng-click="create()">Create</a></div>
            <h2>Create Type</h2>
            <div>
                <label>Name</label>
                <input type="text" data-ng-model="type.name" />
            </div>
            <div><button data-ng-click="addField()">Add Field</button></div>
            <table>
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Field</th>
                        <th>Input</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-ng-repeat="field in type.fields">
                        <td><input type="text" data-ng-model="field.label" /></td>
                        <td><input type="text" data-ng-model="field.name" /></td>
                        <td><input type="text" data-ng-model="field.input" /></td>
                        <td><input type="text" data-ng-model="field.type" /></td>
                        <td><button data-ng-click="removeField(field)">Remove</button></td>
                    </tr>
                </tbody>
            </table>
            <div><button data-ng-click="">Add Key</button></div>
            <table>
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-ng-repeat="key in type.keys">
                        <td><input type="text" data-ng-model="key.name" /></td>
                        <td><input type="text" data-ng-model="key.type" /></td>
                        <td><button data-ng-click="removeKey(key)">Remove</button></td>
                    </tr>
                </tbody>
            </table>
            <div><button data-ng-click="save()">Save</button></div>
        </script>


        <script src="lib/jquery/1.8.0/jquery.min.js"></script>
        <script src="lib/jquery-ui-1.8.23.custom/js/jquery-ui-1.8.23.custom.min.js"></script>
        <script src="lib/angular/angular.js"></script>
        <script src="lib/angular/angular-ui.min.js"></script>
        <script src="lib/angular/angular-resource.js"></script>

        <script src="lib/pagic/0.0.1/pagic.js"></script>

    </body>
</html>
