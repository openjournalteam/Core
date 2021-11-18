# Basic Usage

```html
<select name="test" data-control="select2">
    <option value="1">Option 1</option>
    <option value="2">Option 2</option>
    <option value="3">Option 3</option>
</select>
```

## Configuration
See [data-* attributes](https://select2.org/configuration/data-attributes).

## Note
* For select2 to work on modal bootstrap dialogs, you need to add the following attribute to your select element: `data-dropdown-parent` with value of modal dialog id.


## Example Select2 with Ajax request
```html
<select class="form-select form-select-solid" 
    data-control="select2"
    data-width="100%" 
    data-dropdown-parent="#modal-form-customer"
    data-placeholder="Select an option" data-allow-clear="true"
    data-ajax--url="{{URL}}" 
    data-ajax--delay="700" multiple>
</select>
```

## Example Controller for Response Select2 with ajax request
```php
public function options(Request $request)
{
    $search = $request->input('search');

    $roles = Role::orderBy('name')->select(['id', 'name as text'])->where('name', 'like', '%' . $search . '%')->limit(5)->get();
    
    return response()->json([
        'results' => $roles,
    ]);
}
```
* Response will be like this : 
```json
{
  results: [
    {id: 1, text: "Admin"}, 
    {id: 13, text: "Support"}, 
    {id: 9, text: "User"} 
  ]
}
```