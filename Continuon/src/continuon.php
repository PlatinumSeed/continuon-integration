<?php
namespace Platinumseed\Continuon;

use Config;

class Continuon
{

    function send($data)
	{
        echo '<pre>';
        print_r(Config::get('continuon.continuon.server'));
        echo '</pre>';
        die();

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, Config::get('continuon.continuon.server'));
		curl_setopt($ch, CURLOPT_POST, 1);

		$options = array(
			'user' => array(
				'name' => $data['fullname'],
				'email' => $data['email'],
				'cellphone' => $data['contact_number'],
				'gender' => $data['gender'],
				'birthdate' => $data['birthday'],
				'area' => $data['location'],
				'opt_in_sms' => $data['sms_opt_in'],
				'opt_in_email' => $data['email_opt_in'],
				//'lists' => array(11)
			),
			'brand_user' => array(
				'brand_id' => Config::get('continuon.continuon.brand_id')
			),
			'source' => array(
				'token' => Config::get('continuon.continuon.token')
			)
		);

		if(!empty($data['facebook_account']['access_token']))
		{
			$options['facebook_account'] = array(
				'access_token' => $data['facebook_account']['access_token']
			);
		}
		if(!empty($data['twitter_account']['access_token']))
		{
			$options['twitter_account'] = array(
				'oauth_token' => $data['twitter_account']['access_token'],
				'oauth_token_secret' => $data['twitter_account']['oauth_token_secret']
			);
		}
		if(!empty($data['instagram_account']['access_token']))
		{
			$options['instagram_account'] = array(
				'access_token' => $data['instagram_account']['access_token']
			);
		}

		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($options));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);


        //echo '<pre>';
        //print_r($server_output);
        //echo '</pre>';
        //die();

		curl_close($ch);

		//print_r($server_output);exit;
		$continuon_response = json_decode($server_output);

        //echo '<pre>';
        //print_r($continuon_response);
        //echo '</pre>';
        //die();

		if (isset($continuon_response) && is_object($continuon_response)) {
			return $continuon_response->user->id;
		}
		else {
			return 'failed';
		}
	}

}
