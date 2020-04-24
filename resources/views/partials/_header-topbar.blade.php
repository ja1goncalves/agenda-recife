<!-- begin:: Header Topbar -->
<div class="kt-header__topbar">
    <!--begin: User bar -->
    <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
            <span class="kt-hidden kt-header__topbar-welcome">Hi,</span><span class="kt-hidden kt-header__topbar-username">Nick</span>
            {{-- <img class="kt-hidden" alt="Pic" src="./assets/media/users/300_21.jpg"/> --}}
            <span class="kt-header__topbar-icon kt-hidden-"><i class="flaticon2-user-outline-symbol"></i></span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
            <?php echo view("partials/_dropdown-user")->render(); ?>
        </div>
    </div>
    <!--end: User bar -->
</div>
<!-- end:: Header Topbar -->
