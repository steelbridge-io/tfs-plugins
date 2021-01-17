<?php

namespace ElfsightInstagramFeedApi;


class Endpoint {
    private $Api;

    private $client;

    static $ERROR_PRIVATE;
    static $ERROR_USER;

    public function __construct($Api, $client) {
        self::$ERROR_PRIVATE = __('This account is private and can\'t be displayed. Please, use a public account as the source.');
        self::$ERROR_USER = __('Cant load user data. Please, try again later.');

        $this->Api = $Api;

        $this->client = $client;
    }

    public function getUser($username) {
        $stored = $this->Api->IGUser->get($username);

        if (!$stored) {
            $response = $this->Api->request('get', 'https://api.instacloud.io/?path=%2Fv1%2Fusers%2F' . $username);
            $data = json_decode($response['body'], true);

            if ((isset($data['meta']) && isset($data['meta']['code']) && $data['meta']['code'] !== 200) || empty($data['data'])) {
                return $this->Api->error(400, self::$ERROR_USER);
            }

            $user = $data['data'];
            $this->Api->IGUser->set($username, $user);

            $this->Api->Debug->dd($data);

            return $user;
        }

        return $stored;
    }

    public function userMedia($username) {
        $data = array();

        $cache_key = '@' . $username . '_media';
        $cache_expired = $this->Api->Cache->expired($cache_key);
        if ($this->Api->debugMode) {
            $cache_expired = true;
        }

        $this->Api->maxId = $this->Api->input('max_id', null, false);
        $this->Api->metaInfo['throttle_limited'] = $limited = false;

        if (class_exists($this->Api->Throttle)) {
            $this->Api->metaInfo['throttle_limited'] = $limited = $this->Api->Throttle->isLimited();
        }

        if ($cache_expired && !$limited) {
            $user = $this->getUser($username);

            $this->Api->user = $user;

            $data = $this->Api->recursiveQueryRequest(
                $cache_key,
                array(
                    'id' => $user['id'],
                    'first' => 50
                ),
                '2c5d4d8b70cad329c4a6ebe3abb6eedd',
                array(),
                0
            );

            $this->Api->Debug->dd($data);
        }

        $result = $this->Api->fallbackCache(array('key' => $cache_key, 'expired' => $cache_expired), $data);
        list ($result_page, $pagination) = $this->Api->paginate($result, 'max_id');
        return $this->Api->response(array(
            'meta' => $this->Api->getMeta(200),
            'pagination' => $pagination,
            'data' => $result_page
        ), array('encode' => true));
    }

    function tagMedia($tag) {
        $data = array();

        $cache_key = '#' . $tag;
        $cache_expired = $this->Api->Cache->expired($cache_key);
        if ($this->Api->debugMode) {
            $cache_expired = true;
        }

        $this->Api->maxId = $this->Api->input('max_tag_id', null, false);
        $this->Api->metaInfo['throttle_limited'] = $limited = false;

        if (class_exists($this->Api->Throttle)) {
            $this->Api->metaInfo['throttle_limited'] = $limited = $this->Api->Throttle->isLimited();
        }

        if ($cache_expired && !$limited) {
//            $page_res = $this->Api->request('get', $this->client['base_url'] . '/explore/tags/' . $tag . '/');
//
//            if (class_exists($this->Api->Throttle)) {
//                $this->Api->Throttle->increment();
//            }
//            $this->Api->checkResponse($page_res, true);
//
//            $page_data = $this->Api->getPageData($page_res['body']);
//            $hashtag_data = $this->Api->getEntryData($page_data, array('TagPage', '0', 'graphql', 'hashtag'));
//            $nodes = array_merge_recursive(
//                $hashtag_data['edge_hashtag_to_top_posts']['edges'],
//                $hashtag_data['edge_hashtag_to_media']['edges']
//            );
//
//            $page_formatted_data = $this->Api->Format->formatNodes($nodes, 'hashtag');

            $data = $this->Api->recursiveQueryRequest(
                $cache_key,
                array(
                    'tag_name' => $tag,
                    'first' => 50
                ),
                '174a5243287c5f3a7de741089750ab3b',
//                $page_formatted_data,
//                count($page_formatted_data)
                array(),
                0
            );

            $this->Api->Debug->dd($data);
        }

        $result = $this->Api->fallbackCache(array('key' => $cache_key, 'expired' => $cache_expired), $data);
        list ($result_page, $pagination) = $this->Api->paginate($result, 'max_tag_id');
        return $this->Api->response(array(
            'meta' => $this->Api->getMeta(200),
            'pagination' => $pagination,
            'data' => $result_page
        ), array('encode' => true));
    }

    function locationMedia($location_id) {
        $data = array();

        $cache_key = '&' . $location_id;
        $cache_expired = $this->Api->Cache->expired($cache_key);
        if ($this->Api->debugMode) {
            $cache_expired = true;
        }

        $this->Api->maxId = $this->Api->input('max_id', null, false);
        $this->Api->metaInfo['throttle_limited'] = $limited = false;

        if (class_exists($this->Api->Throttle)) {
            $this->Api->metaInfo['throttle_limited'] = $limited = $this->Api->Throttle->isLimited();
        }

        if ($cache_expired && !$limited) {
            $data = $this->Api->recursiveQueryRequest(
                $cache_key,
                array(
                    'id' => $location_id,
                    'first' => 50
                ),
                '1b84447a4d8b6d6d0426fefb34514485'
            );

            $this->Api->Debug->dd($data);
        }

        $result = $this->Api->fallbackCache(array('key' => $cache_key, 'expired' => $cache_expired), $data);
        list ($result_page, $pagination) = $this->Api->paginate($result, 'max_tag_id');
        return $this->Api->response(array(
            'meta' => $this->Api->getMeta(200),
            'pagination' => $pagination,
            'data' => $result_page
        ), array('encode' => true));
    }

    function shortcode($shortcode) {
        $data = array();

        $cache_key = '&' . $shortcode;
        $cache_expired = $this->Api->Cache->expired($cache_key);
        if ($this->Api->debugMode) {
            $cache_expired = true;
        }

        if ($cache_expired) {
            $query_res = $this->Api->queryRequest(array(
                'shortcode' => $shortcode,
                'child_comment_count' => 3,
                'fetch_comment_count' => 40,
                'parent_comment_count' => 24,
                'has_threaded_comments' => true
            ), '55a3c4bad29e4e20c20ff4cdfd80f5b4');

            if ($this->Api->checkResponse($query_res, false)) {
                $reponse_data = json_decode($query_res['body'], true);
                $shortcode_data = $reponse_data['data']['shortcode_media'];
                $data = $this->Api->Format->formatMedia($shortcode_data);
            }
        }

        $result = $this->Api->fallbackCache(array('key' => $cache_key, 'expired' => $cache_expired), $data);
        return $this->Api->response(array(
            'meta' => $this->Api->getMeta(200),
            'data' => $result
        ), array('encode' => true));
    }

    function user($username) {
        $data = array();

        $cache_key = '@' . $username . '_profile';
        $cache_expired = $this->Api->Cache->expired($cache_key);

        if ($cache_expired) {
            $data = $this->getUser($username);

            // @TODO find the query for 3-in-1 request / deprecate topSearch in user endpoint

            $queryFollowData = json_decode($this->Api->queryRequest(
                array(
                    'id' => $data['id'],
                    'first' => 0
                ),
                'd04b0a864b4b54837c0d870b0e77e076'
            )['body'], true);
            $followCount = $queryFollowData['data']['user']['edge_follow']['count'];

            $queryFollowersData = json_decode($this->Api->queryRequest(
                array(
                    'id' => $data['id'],
                    'first' => 0
                ),
                17851374694183129
            )['body'], true);
            $followersCount = $queryFollowersData['data']['user']['edge_followed_by']['count'];

            $queryMediaData = json_decode($this->Api->queryRequest(
                array(
                    'id' => $data['id'],
                    'first' => 0
                ),
                'f2405b236d85e8296cf30347c9f08c2a'
            )['body'], true);
            $mediaCount = $queryMediaData['data']['user']['edge_owner_to_timeline_media']['count'];

            $data['counts']['media'] = $mediaCount;
            $data['counts']['follows'] = $followCount;
            $data['counts']['followed_by'] = $followersCount;

            $this->Api->Cache->set($cache_key, $data);
        }

        $result = $this->Api->fallbackCache(array('key' => $cache_key, 'expired' => $cache_expired), $data);
        return $this->Api->response(array(
            'meta' => $this->Api->getMeta(200),
            'data' => $result
        ), array('encode' => true));
    }
}
