<?php

use yii\db\Migration;

/**
 * Class m201213_134650_admin_user_data
 */
class m201213_134650_admin_user_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $connection = Yii::$app->getDb();
        $connection->createCommand("
            INSERT INTO user (id, username, auth_key, password_hash, password_reset_token, email, status, created_at, updated_at, verification_token) 
            VALUES (1, 'admin', :auth, :hash, null, 'adm@adm.loc', 10, 1602189564, 1602189564, null);
        ", [
            ':auth' => '8uXyWtmlSpK3ERHGBlR6TG3Igu6o20Qz',
            ':hash' => '$2y$13$B/S/CeqnIsDUT9hTR0LaCOtr9YCV226D3BZ66Bs0ATK5MDJUJgK9m'
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201213_134650_admin_user_data cannot be reverted.\n";

        return false;
    }}
