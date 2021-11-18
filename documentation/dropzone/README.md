# Basic Usage

```html
<input type="file" data-control="dropzone" name="profile" />
```

## Configuration

| attributes         | default                                                                                     |
| ------------------ | ------------------------------------------------------------------------------------------- |
| name               | file                                                                                        |
| multiple           | null                                                                                        |
| accept             | .csv,.txt,.xlx,.xls,.pdf,.gif,.jpeg,.jpg,.png,.pdf,.gif,.xls,.xlsx,.txt,.geojson,.doc,.docx |
| data-max-file-size | 10                                                                                          |
| data-max-files     | null                                                                                        |

## Note

- Uploaded file will be saved in the `storage/upload/temporary` folder with timestamp folder.
- When upload success dropzone will append form with hidden input with name that set with attribute `name` or if it not set it will use `file` field with value of encrypted path to uploaded file.

## Saving to Media Library

### When upload with multiple files

```php
if ($files = $request->input('file')) {
  $model->saveAttachments($files);
}
```

### When Upload with single file

```php
if ($file = $request->input('file')) {
  $model->saveAttachment($files);
}
```

- Make sure to implement `HasMedia` trait in your model and use `InteractsWithHashedMedia` trait in your model. for more information see [Media Library](https://spatie.be/docs/laravel-medialibrary/v9/basic-usage/preparing-your-model)

## Example Response For Modal Form Edit

```php
public function edit(Request $request, Customer $customer)
{
  $mediaList = $customer->getMedia();

  $media = [];

  foreach ($mediaList as $mediaItem) {
    $media[] = [
      'uuid' => $mediaItem->uuid,
      'name' => $mediaItem->file_name,
      'url' => $mediaItem->getUrl(),
      'size' => $mediaItem->size,
      'mime_type' => $mediaItem->mime_type,
    ];
  }

  $customer->profile = $media;

  return response()->json($customer->makeHidden(['updated_at', 'created_at', 'media']));
}
```
