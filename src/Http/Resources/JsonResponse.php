<?php



namespace OpenJournalTeam\Core\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class JsonResponse implements \JsonSerializable
{
    public const STATUS_SUCCESS = true;
    public const STATUS_ERROR = false;

    /**
     * Data to be returned
     */
    private mixed $data = [];

    /**
     * Error message in case process is not success. This will be a string.
     */
    private string $error = '';

    private bool $success = false;

    /**
     * JsonResponse constructor.
     */
    public function __construct(mixed $data = [], string $error = '')
    {
        if ($this->shouldBeJson($data)) {
            $this->data = $data;
        }

        $this->error = $error;
        $this->success = !empty($data);
    }

    /**
     * Success with data
     *
     * @param array $data
     */
    public function success(array $data = []): void
    {
        $this->success = true;
        $this->data = $data;
        $this->error = '';
    }

    /**
     * Fail with error message
     */
    public function fail(string $error = ''): void
    {
        $this->success = false;
        $this->error = $error;
        $this->data = [];
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'success' => $this->success,
            'data' => $this->data,
            'error' => $this->error,
        ];
    }

    /**
     * Determine if the given content should be turned into JSON.
     */
    private function shouldBeJson(mixed $content): bool
    {
        return $content instanceof Arrayable ||
            $content instanceof Jsonable ||
            $content instanceof \ArrayObject ||
            $content instanceof \JsonSerializable ||
            is_array($content);
    }
}
