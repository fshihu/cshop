<?php

/**
 * User: fu
 * Date: 2016/3/10
 * Time: 14:30
 */
spl_autoload_register(function ($class){
    if(strpos($class,'app\\admin') === 0){
        $class = strpos('app','application');
        include $class;
    }
});

return array_merge_recursive(include __DIR__ . '/../../conf.php', array(
    'params' => array(//自定义参数
        'bgtask_fail_fn' => function ($id,$msg) {
//            \CC\util\external\mail\Mail::sendMsg('444212235@qq.com', 'bgtask', 'caipao error', 'caipao error，'.$msg);
        },
        'pay' => array(
            'alipay' => array(
                'appId' => '2017062707576846',
                'rsaPrivateKey' => 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC45/8qOH8vOUT5KSVep6uZAxMxFD7aKs3GaCMN9L+ufxSDzQdNxBre2dmKcuyepB/pN8548ly4Vu5vxV7r2JgoqmtA5NMCRYH/r7IwmVq3SnXmomyxAvsYw3QtrTsszkqYqfpH1lgGZkBHx+iAs3MsLPXmEkyxJb4xK/oGZbqCGvlJD/AFsfQPKZwenfbkCIMDH64e9D6C3fc4DO5O7WaQOM+O4UFqRfuhbucsUODJijH0UYD5dn3MqRkd5d9uCDsyPjARX9YYv2mk2lJmujABmt4MkIglkQ/iTwRbWXNwyoSc2WCFzAdVCw1SQu0xWebV30DFPgpZdQ0xhGyF8LphAgMBAAECggEARdouxQ5uzbI+4jmvCmEhLD7DI0lYrSZ6cjeo9n69YvhTEa+E0NYCqKl3yxu7U/sAqyQP9hTo/iKpFMRlJYe/g61Ns0g+hp8niyYelMl6Qb/5ZlV55i0QGrzLyO2mazjLaXzdNgI9Yr2CDxvwM56XJdseUfobythNT1ojrAMGQFu2LtEkYVOuTBk2ocN+HZuqjygPhkiscnz/waPomeX5ONOIIWb1eLm82bXixGABZoc5133++Vz4/LzzMUxXMP8kyQ7JYgKqVAsGaWioDcYsnRBTWWgfJKLFuKl2Pz9bjRbaE8L/bbKeehucRX4tQYweYopq7s2uU05kx4UDQ+/COQKBgQD7iTRB3pZ0IiUsoOXDfhkSt7r9qM5hE75wIsR6wozYaeFK8Jn4dg7XpnJmFoCUY4EV8Znmp570XTr/ep4On57CAQrmcWMfoquejFqvOiNq+yHZsyyPhHhxHlD8pQOMkZ1HXFZTLAu8f9R7MJ5iiMxsVdP8HDS34nXEsKseP6cnUwKBgQC8MBNmqBGD23xPnOIe6dX1fLA/Zj4oGSQDQtMBj6jM3U/1uq6IN8klo/oplavXclV08ttvztAWnzOzNM/S/Ay5m9+HPmBOFL4McMq7koTrKtwx48RgZQVnk3bgL2F5eA+nj/7U2FrQFqT1LZdcUSTbsLI5ituQ3g9POat4aTSk+wKBgQCPGE/dRSasbJxfVi0/2KWk61b6ZST7PwMwweaqu7DqkNl1C4lcOrVY4zzjbNu7Dxxpgmd+O0+HTt54ZqYyRYZIcdVkoY61eZJOgSQ52UY63yEzuuWXw9HM8GU8RRfOySwDY7lMWZtXohUb+92uyooY+368RsOK9M7wlVzTuXx7NwKBgFZgdrc603dDSia8qqlnyTY5eihPhJ4hE/+PL4za5K7LskTm3+9UM7ZcMpndwhdMul7IjeIe+jI39qH9zppX6HtVSV8pSUjtimHpb5Ry5yGN9a3Mjrl0BOwKqpiyBrqbWgweMuh9OgmjKyoCOCQ+dn2D9/ojey5eToadwM+u8mP7AoGBAJ1Vi2stHq9zgzMXOmH71QKVZo7OmSXWKb2S2WJ5VR+yifaub93iDhv4I1y4U6Kf/OLQVaImdV2srA7DZuwXJ8AsAkHKQt3mLsgTWa5FQUGt/rbFgnh3l8gepr6+9IbvSUhaVQ+ZSWFxUDgAm1uemxNHpgseC3/KYa2TrxoYbyMT',
                'alipayrsaPublicKey' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuOf/Kjh/LzlE+SklXqermQMTMRQ+2irNxmgjDfS/rn8Ug80HTcQa3tnZinLsnqQf6TfOePJcuFbub8Ve69iYKKprQOTTAkWB/6+yMJlat0p15qJssQL7GMN0La07LM5KmKn6R9ZYBmZAR8fogLNzLCz15hJMsSW+MSv6BmW6ghr5SQ/wBbH0DymcHp325AiDAx+uHvQ+gt33OAzuTu1mkDjPjuFBakX7oW7nLFDgyYox9FGA+XZ9zKkZHeXfbgg7Mj4wEV/WGL9ppNpSZrowAZreDJCIJZEP4k8EW1lzcMqEnNlghcwHVQsNUkLtMVnm1d9AxT4KWXUNMYRshfC6YQIDAQAB',
            )
        )
    ),
    'cc_class_config' => array(
        'response/CRenderData' => array(
            'groupLayouts' => array(
                'admin' => '/layouts/default',
                'wx' => '/layouts/mobile',
            ),
        ),
        'util/encrypt/Password' => array(
            'salt' => '8Z6UYmJv5FPbdTgbtk9AK6D2QGBvZG26',
        )
    ),
    'di' => array(
        'conf' => include __DIR__.'/di.php',
    ),
    'env' => array(
        'api' => 'api,userapi',
        'web' => 'admin,xbwqLink',
        'cmd' => 'cmd',
        'sign' => array(
            'timesign' => 600,
            'sign_secretkey' => 'RThXxpuR5n9p7CYSTWFy5awyBYnXeBdj',
            'no_sign_action' => array(
                array('action' => '/share/link/down'),
            )
        )
    )
));
