# Basic Usage

```html
<input type="file" data-control="dropzone">
```

## Configuration
| attributes | default |
| --- | --- |
| multiple | null |
| accept | .csv,.txt,.xlx,.xls,.pdf,.gif,.jpeg,.jpg,.png,.pdf,.gif,.xls,.xlsx,.txt,.geojson,.doc,.docx |
| data-max-file-size | 10 |
| data-max-files | null | 
| data-url | attachment |


## Note
* Uploaded file will be saved in the `storage/upload/temporary` folder with timestamp folder.
* When upload success dropzone will append form with hidden `file` field with value of encrypted path to uploaded file.

## Saving to Media Library
```php
$attachmentManager = new AttachmentManager();

if ($files = $request->input('file')) {
  // Check if uploaded file is multiple
  if (is_array($files)) {
    foreach ($files as $file) {
      $path = $attachmentManager->getPathFromEncrypt($file);
      $model->addMedia($path)->toMediaCollection();
    }
  } else {
    $path = $attachmentManager->getPathFromEncrypt($files);
    $model->addMedia($path)->toMediaCollection();
  }
}
```
* Make sure to implement `HasMedia` trait in your model and use `InteractsWithMedia` trait in your model. for more information see [Media Library](https://spatie.be/docs/laravel-medialibrary/v9/basic-usage/preparing-your-model)

## Example Response For Modal Form Edit
```php
public function edit(Request $request, Customer $customer)
{
  if (!$request->ajax()) {
    return abort(401);
  }

  $mediaList = $customer->getMedia('images');

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

  $customer->attachment = $media;

  return response()->json($customer->makeHidden(['updated_at', 'created_at', 'media']));
}
```