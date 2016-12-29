<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Server_Config
 * @property string gadget_name
 * @property string name
 * @property string password
 * @property string admin_password
 * @property string motd
 * @property int motd_interval
 * @property int max_players
 * @property boolean kick_duplicates
 * @property int verify_signatures
 * @property string headless_clients
 * @property int vote_mission_players
 * @property float vote_threshold
 * @property boolean disable_von
 * @property int von_codec_quality
 * @property boolean persistent
 * @property boolean battle_eye
 * @property int max_ping
 * @property int max_desync
 * @property float max_packetloss
 * @property int disconnect_timeout
 * @property boolean kick_clients_on_slow_network
 * @property string double_id_detected
 * @property string on_user_connected
 * @property string on_user_disconnected
 * @property string on_hacked_data
 * @property string on_different_data
 * @property string on_unsigned_data
 * @property string regular_check
 * @property string mission
 * @property int modpack_id
 */
class Server_Config extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'server_configs';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}