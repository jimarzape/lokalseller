
<?php

function _pages()
{
	$pages = array();

    $details['title']   = 'Dashboard'; 
    $details['icon']    = 'mdi mdi-gauge';
    $details['url']     = route('home');
    $details['status']  = '';
    $details['desc']    = 'nav.dash';
    $details['class']   = '';
    $details['has_sub'] = false;
    $details['sub']     = array();
    array_push($pages, $details);

    $details['title']   = 'Products'; 
    $details['icon']    = 'mdi mdi-basket';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.products';
    $details['class']   = 'has-arrow';
    $details['has_sub'] = true;
    $details['sub']     = array();

    $sub['title']       = 'Manage Products';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.products.manage';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Add Products';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.products.add';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Media Center';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.products.media.center';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Manage Image';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.products.manage.image';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Decorate Products';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.products.decorate';
    
    array_push($details['sub'], $sub);
    

    array_push($pages, $details);

    $details['title']   = 'Orders & Review'; 
    $details['icon']    = 'mdi mdi-message-bulleted';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.orders-n-review';
    $details['class']   = 'has-arrow';
    $details['has_sub'] = true;
    $details['sub']     = array();

    $sub['title']       = 'Orders';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.orders.orders';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Return Orders';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.orders.returns';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Reviews';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.orders.reviews';
    
    array_push($details['sub'], $sub);
    
    array_push($pages, $details);

    $details['title']   = 'Sponsored Solutions'; 
    $details['icon']    = 'mdi mdi-lightbulb-on';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.sponsored';
    $details['class']   = 'has-arrow';
    $details['has_sub'] = true;
    $details['sub']     = array();

    $sub['title']       = 'Overview';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Sponsored Search';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.search';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Sponsored Affiliate';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.affiliate';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Sponsored Affiliate Reports';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.affiliate.reports';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Change History';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.change.history';
    
    array_push($details['sub'], $sub);

    array_push($pages, $details);

    $details['title']   = 'Traffic'; 
    $details['icon']    = 'mdi mdi-traffic-light';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.sponsored';
    $details['class']   = 'has-arrow';
    $details['has_sub'] = true;
    $details['sub']     = array();

    $sub['title']       = 'Seller Picks';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Feed';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Sponsored Products';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    array_push($pages, $details);

    $details['title']   = 'Promotions'; 
    $details['icon']    = 'mdi mdi-octagram';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.sponsored';
    $details['class']   = 'has-arrow';
    $details['has_sub'] = true;
    $details['sub']     = array();

    $sub['title']       = 'Campaign';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Flexi Combo';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Seller Voucher';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Free Shipping';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Bundles';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    array_push($pages, $details);

    $details['title']   = 'Store Decorations'; 
    $details['icon']    = 'mdi mdi-store';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.sponsored';
    $details['class']   = '';
    $details['has_sub'] = false;
    $details['sub']     = array();
    array_push($pages, $details);

    $details['title']   = 'Growth Center'; 
    $details['icon']    = 'mdi mdi-arrow-up-bold-hexagon-outline';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.sponsored';
    $details['class']   = 'has-arrow';
    $details['has_sub'] = true;
    $details['sub']     = array();

    $sub['title']       = 'Challenges & Rewards';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Policy Compliance';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Assortment Growth';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    array_push($pages, $details);

    $details['title']   = 'Business Advisor'; 
    $details['icon']    = 'mdi mdi-account-network';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.sponsored';
    $details['class']   = '';
    $details['has_sub'] = false;
    $details['sub']     = array();
    array_push($pages, $details);


    $details['title']   = 'Finance'; 
    $details['icon']    = 'mdi mdi-calculator';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.sponsored';
    $details['class']   = 'has-arrow';
    $details['has_sub'] = true;
    $details['sub']     = array();

    $sub['title']       = 'Account Statements';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);
    array_push($pages, $details);

    $details['title']   = 'Support'; 
    $details['icon']    = 'mdi mdi-headset';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.sponsored';
    $details['class']   = 'has-arrow';
    $details['has_sub'] = true;
    $details['sub']     = array();

    $sub['title']       = 'Seller Policies';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Help Center';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Service Market Place';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    array_push($pages, $details);

    $details['title']   = 'My Account'; 
    $details['icon']    = 'mdi mdi-account-settings-variant';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.sponsored';
    $details['class']   = 'has-arrow';
    $details['has_sub'] = true;
    $details['sub']     = array();

    $sub['title']       = 'Profile';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';

    array_push($details['sub'], $sub);

    $sub['title']       = 'User Management';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Account Settings';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    $sub['title']       = 'Chat Settings';
    $sub['icon']        = '';
    $sub['url']         = '';
    $sub['status']      = '';
    $sub['desc']        = 'nav.sponsored.overview';
    
    array_push($details['sub'], $sub);

    array_push($pages, $details);

    $details['title']   = 'Feed Back'; 
    $details['icon']    = 'mdi mdi-message-draw';
    $details['url']     = 'javascript:void(0)';
    $details['status']  = '';
    $details['desc']    = 'nav.sponsored';
    $details['class']   = '';
    $details['has_sub'] = false;
    $details['sub']     = array();
    array_push($pages, $details);

    return $pages;

}


function pages($title = 'Dashboard', $sub_menu = '')
{
    $pages = _pages();
    
    $_pages['pages']    = array();
    $_pages['active']   = array();
    $_pages['active_title'] = '';
    foreach($pages as $page)
    {
        if($page['title'] == $title)
        {
            $page['status']         = 'active';
            $_pages['active_title'] = $page['title'];
            $active['active_title'] = $page['title'];
            $active['active_url']   = $page['url'];
            
            array_push($_pages['active'], $active);
            
            $temp_sub               = array();
            foreach($page['sub'] as $subs)
            {
                if($subs['title'] == $sub_menu)
                {
                    $subs['status']         = 'active';
                    $_pages['active_title'] = $subs['title'];
                    $active['active_title'] = $subs['title'];
                    $active['active_url']   = 'javascript:void(0)';
            
                    array_push($_pages['active'], $active);
                }
                
                array_push($temp_sub, $subs);
            }
            
            $page['sub'] = $temp_sub;
        }
        array_push($_pages['pages'], $page);
    }
    
    // return checkaccess($user_id ,$_pages);
    return $_pages;
}


function page_access($pages, $access)
{
    foreach($pages as $key => $page)
    {
        $pages[$key]['enable'] = false; 
        if(isset($access[$page['desc']]))
        {
            $pages[$key]['enable'] = true;
        }

        foreach($page['sub'] as $sub_key => $sub)
        {
            $pages[$key]['sub'][$sub_key]['enable'] = false;

            if(isset($access[$sub['desc']]))
            {
                $pages[$key]['sub'][$sub_key]['enable'] = true;
                $pages[$key]['enable'] = true;
            }
        }
    }

    return $pages;
}