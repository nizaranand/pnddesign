<?php

if (!class_exists('wp_adpress_roles')) {
    class wp_adpress_roles
    {
        private $client_role;
        private $client_transfer_role;
        private $client_old_role;
        private $client_old_role_nonactive;
        private $client_allow_upload;

        function __construct()
        {
            // Populate class var.
            $this->populate_var();

            // Admin Cap.
            $this->admin_capabilities();

            // Client Cap.
            $this->client_menu_capabilities();

            // Media Library Cap.
            if ($this->client_allow_upload != 'on') {
                $this->set_cap(__('administrator'), 'adpress_allow_upload');
            } else {
                $this->client_upload_capabilities();
            }
            $this->restrict_medialibrary();
        }

        private function populate_var()
        {
            // Get from settings
            $settings = get_option('adpress_settings');
            $transient = get_option('adpress_roles_transient');

            if (!isset($transient)) {
                $transient = array();
            }
            $this->client_role = $settings['client_role'];
            $this->client_transfer_role = $transient['client_transfer_role'];
            $this->client_old_role = $transient['client_old_role'];
            // Role Updated
            if ($this->client_role != $this->client_transfer_role) {
                $this->client_old_role = $this->client_transfer_role;
                $this->client_transfer_role = $this->client_role;
            }
            $transient['client_transfer_role'] = $this->client_transfer_role;
            $transient['client_old_role'] = $this->client_old_role;
            if (isset($settings['client_allow_upload'])) {
                $this->client_allow_upload = $settings['client_allow_upload'];
            }

            update_option('adpress_settings', $settings);
            update_option('adpress_roles_transient', $transient);
        }

        private function admin_capabilities()
        {
            $admin = get_role(__('administrator'));

            // Menu Capabilities
            $admin->add_cap('adpress_admin_menu');
            $admin->add_cap('adpress_client_menu');

            // Media Uploader Capabilities
            $admin->add_cap('adpress_allow_upload');
        }

        private function client_menu_capabilities()
        {
            global $wp_roles;
            $roles = $wp_roles->get_names();
            if ($this->client_role === 'all') {
                foreach ($roles as $key => $val) {
                    $role = get_role($key);
                    $role->add_cap('adpress_client_menu');
                }
            } else if ($this->client_role === __('administrator')) {
                $this->set_cap(__('administrator'), 'adpress_client_menu');
            } else {
                $this->set_cap($this->client_role, 'adpress_client_menu');
            }
        }

        private function client_upload_capabilities()
        {
            global $wp_roles;
            $roles = $wp_roles->get_names();
            if ($this->client_role === 'all') {
                foreach ($roles as $key => $val) {
                    $role = get_role($key);
                    $role->add_cap('adpress_allow_upload');
                    $role->add_cap('upload_files');
                }
            } else {
                $this->set_cap($this->client_role, 'adpress_allow_upload');
                $this->set_cap($this->client_role, 'upload_files');
            }
        }

        private function set_cap($role, $cap)
        {
            // Remove the cap.
            global $wp_roles;
            $roles = $wp_roles->get_names();
            foreach ($roles as $key => $val) {
                if ($key != __('administrator')) {
                    $user = get_role($key);
                    $user->remove_cap($cap);
                }
            }

            // Set the cap. to the new role
            $user = get_role($role);
            $user->add_cap($cap);
        }

        private function restrict_medialibrary()
        {
            function my_files_only($wp_query)
            {
                if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/upload.php')) {
                    if (!current_user_can('adpress_allow_upload') && current_user_can('adpress_client_menu')) {
                        global $current_user;
                        $wp_query->set('author', $current_user->ID);
                        add_filter('views_upload', 'fix_media_counts');
                    }
                }
                else if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/media-upload.php')) {
                    if (!current_user_can('adpress_allow_upload') && current_user_can('adpress_client_menu')) {
                        global $current_user;
                        $wp_query->set('author', $current_user->ID);
                        add_filter('views_upload', 'fix_media_counts');
                    }
                }
            }

            add_filter('parse_query', 'my_files_only');


            // Fix media counts
            function fix_media_counts($views)
            {
                global $wpdb, $current_user, $post_mime_types, $avail_post_mime_types;
                $views = array();
                $count = $wpdb->get_results("
                    SELECT post_mime_type, COUNT( * ) AS num_posts
                    FROM $wpdb->posts
                    WHERE post_type = 'attachment'
                    AND post_author = $current_user->ID
                    AND post_status != 'trash'
                    GROUP BY post_mime_type
                ", ARRAY_A);
                $_num_posts = array();
                foreach ($count as $row) {
                    $_num_posts[$row['post_mime_type']] = $row['num_posts'];
                }

                $_total_posts = array_sum($_num_posts);

                $detached = isset($_REQUEST['detached']) || isset($_REQUEST['find_detached']);
                if (!isset($total_orphans))
                    $total_orphans = $wpdb->get_var("
                        SELECT COUNT( * )
                        FROM $wpdb->posts
                        WHERE post_type = 'attachment'
                        AND post_author = $current_user->ID
                        AND post_status != 'trash'
                        AND post_parent < 1
                    ");
                $matches = wp_match_mime_types(array_keys($post_mime_types), array_keys($_num_posts));
                foreach ($matches as $type => $reals)
                    foreach ($reals as $real)
                        $num_posts[$type] = (isset($num_posts[$type])) ? $num_posts[$type] + $_num_posts[$real] : $_num_posts[$real];
                $class = (empty($_GET['post_mime_type']) && !$detached && !isset($_GET['status'])) ? ' class="current"' : '';
                $views['all'] = "<a href='upload.php'$class>" . sprintf(__('All <span class="count">(%s)</span>', 'uploaded files'), number_format_i18n($_total_posts)) . '</a>';
                foreach ($post_mime_types as $mime_type => $label) {
                    $class = '';
                    if (!wp_match_mime_types($mime_type, $avail_post_mime_types))
                        continue;
                    if (!empty($_GET['post_mime_type']) && wp_match_mime_types($mime_type, $_GET['post_mime_type']))
                        $class = ' class="current"';
                    if (!empty($num_posts[$mime_type]))
                        $views[$mime_type] = "<a href='upload.php?post_mime_type=$mime_type'$class>" . sprintf(translate_nooped_plural($label[2], $num_posts[$mime_type]), $num_posts[$mime_type]) . '</a>';
                }
                $views['detached'] = '<a href="upload.php?detached=1"' . ($detached ? ' class="current"' : '') . '>' . sprintf(__('Unattached <span class="count">(%s)</span>', 'detached files'), $total_orphans) . '</a>';
                return $views;
            }
        }
    }
}