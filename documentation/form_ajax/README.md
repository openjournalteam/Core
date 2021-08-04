# Basic Usage

Add `data-control="form"` to a form element to enable ajax form submission.

```html
<form action="{{ route('master.customer.save') }}" method="POST" data-control="form">
  ...
</form>
```