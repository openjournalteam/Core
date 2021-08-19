# Basic Usage
Add class `datatables` to `table` tag.

##HTML
```html
<table class="table table-bordered datatables w-100" data-ajax="URL">
  <thead>
      <tr>
          <th class="text-center" style="width:5%" data-data="DT_RowIndex" data-name="index"
              data-orderable="false" data-searchable="false" data-class="text-center">No</th>
          <th data-data="customer" data-name="customer.name">Customer</th>
          <th data-data="created_at" data-name="created_at">Date</th>
          <th data-data="status">Status</th>
          <th data-data="actions" data-orderable="false" data-searchable="false">
              Actions</th>
      </tr>
  </thead>
</table>
```


##PHP
```php
  public function datatable()
  {
      $data = Model::query();
      return DataTables::of($data)
          ->addIndexColumn()
          ->make(true);
  }
```

## Configuration Html
### table tag
| attributes | default | required |
| --- | --- | --- |
| data-ajax  | - | yes |

### td tag

| attributes | default | required |
| --- | --- | --- |
| data-data | - | yes |
| data-name | - | yes |
| data-orderable | true | no |
| data-searchable | true | no |