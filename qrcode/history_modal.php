<?php
session_start();
require_once 'config/config.php';

$id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');

$db = getDbInstance();
$db->where('dynamic_qr_version.id', $id);
$db->where('dynamic_qrcodes.created_by', $_SESSION['user_id']);
$db->join('dynamic_qrcodes', 'dynamic_qrcodes.id=dynamic_qr_version.qr_id');
$row = $db->objectBuilder()->getOne('dynamic_qr_version');
if (is_object($row)) {
    $base_data = base64_decode($row->qr_data);
    $data = unserialize($base_data); ?>
<table class="table table-striped table-bordered">
        <tbody>
            <tr>
                <td>
                    <label>Redirect identifier</label>
                </td>
                <td>
                    <?=$data->identifier?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Nombre</label>
                </td>
                <td>
                    <?=$data->filename?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>URL</label>
                </td>
                <td>
                    <?=$data->link?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Redirigir a URL</label>
                </td>
                <td>
                    <?=$data->state?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Default</label>
                </td>
                <td>
                    <?=($data->is_default)?'Default QR':'Normal QR'?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Used For</label>
                </td>
                <td>
                    <?=$data->used_for?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Created At</label>
                </td>
                <td>
                    <?=$row->created_at?>
                </td>
            </tr>
        </tbody>
</table>
<?php
} else {
        echo '<h3>No QR Data Found</h3>';
    }?>