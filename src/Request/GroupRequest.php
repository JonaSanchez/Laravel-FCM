<?php

namespace LaravelFCM\Request;

/**
 * Class GroupRequest.
 */
class GroupRequest extends BaseRequest
{
    /**
     * @internal
     *
     * @var string
     */
    protected $operation;

    /**
     * @internal
     *
     * @var string
     */
    protected $notificationKeyName;

    /**
     * @internal
     *
     * @var string
     */
    protected $notificationKey;

    /**
     * @internal
     *
     * @var array
     */
    protected $registrationIds;

    /**
     * GroupRequest constructor.
     *
     * @param                   $operation
     * @param                   $notificationKeyName
     * @param                   $notificationKey
     * @param                   $registrationIds
     * @param   string|null     $server_key // overwrites the one in .env file
     * @param   string|null     $sender_id  // overwrites the one in .env file
     */
    public function __construct($operation, $notificationKeyName, $notificationKey, $registrationIds, $server_key = null, $sender_id = null)
    {
        parent::__construct();

        $this->operation = $operation;
        $this->notificationKeyName = $notificationKeyName;
        $this->notificationKey = $notificationKey;
        $this->registrationIds = $registrationIds;

        // If $server_key and $sender_id are passed, overwrite the ones in config
        // allows for multiple senders
        if ($server_key && $sender_id) {
            $this->overwriteServerKeyAndSenderId($server_key, $sender_id);
        }
    }

    /**
     * Build the header for the request.
     *
     * @return array
     */
    protected function buildBody()
    {
        return [
            'operation' => $this->operation,
            'notification_key_name' => $this->notificationKeyName,
            'notification_key' => $this->notificationKey,
            'registration_ids' => $this->registrationIds,
        ];
    }
}
