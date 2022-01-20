<?php

namespace OpenJournalTeam\Core\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetSetting extends Model
{
  protected $fillable = ['name', 'setting', 'value', 'type', 'user_id'];

  public function getValueAttribute($value)
  {
    switch ($this->type) {
      case 'bool':
      case 'boolean':
        $value = (bool) $value;
        break;
      case 'int':
      case 'integer':
        $value = (int) $value;
        break;
      case 'float':
      case 'number':
        $value = (float) $value;
        break;
      case 'object':
      case 'array':
        if (gettype($value) == 'array') {
          break;
        }
        $decodedValue = json_decode($value, true);
        if (!is_null($decodedValue)) {
          $value = $decodedValue;
        } else {
          $value = unserialize($value);
        }
        break;
      case 'date':
        if ($value !== null) $value = strtotime($value);
        break;
      case 'string':
      default:
        // Nothing required.
        break;
    }
    return $value;
  }

  public static function boot()
  {
    parent::boot();
    self::creating(function ($model) {
      $model->type = gettype($model->value);

      $value = $model->value;

      switch ($model->type) {
        case 'object':
        case 'array':
          $value = json_encode($value, JSON_UNESCAPED_UNICODE);
          break;
        case 'bool':
        case 'boolean':
          // Cast to boolean, ensuring that string
          // "false" evaluates to boolean false
          $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
          break;
        case 'int':
        case 'integer':
          $value = (int) $value;
          break;
        case 'float':
        case 'number':
          $value = (float) $value;
          break;
        case 'date':
          if ($value !== null) {
            if (!is_numeric($value)) $value = strtotime($value);
            $value = strftime('%Y-%m-%d %H:%M:%S', $value);
          }
          break;
        case 'string':
        default:
          // do nothing.
      }

      $model->value = $value;
    });
  }

  public function scopeSettingSystemByUser($query, $userId = false)
  {
    if (!$userId) {
      $userId = user()?->id;
    }

    return $query->where('setting', 'system')->where('user_id', $userId);
  }

  public function scopeSettingSystemByNameAndUser($query, $name, $userId = false)
  {
    if (!$userId) {
      $userId = user()?->id;
    }

    return $query->settingSystemByUser($userId)->where('name', $name);
  }
}
