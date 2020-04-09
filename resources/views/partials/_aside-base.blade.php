<?php
    $current_page = Route::current()->getName();
?>
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside kt-aside--fixed kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper" style="margin-top: -50px;">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500" >
            <ul class="kt-menu__nav">
                <li class="kt-menu__item {{ in_array($current_page, ['events', 'view-event']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true" >
                    <a href="{{ route('events') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-calendar-6"></i><span class="kt-menu__link-text">Eventos</span></a>
                </li>
                <li class="kt-menu__item {{ in_array($current_page, ['ads', 'add-ad', 'del-ad', 'edit']) ? 'kt-menu__item--active' : '' }} " aria-haspopup="true" >
                    <a href="{{ route('ads') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-analytics"></i><span class="kt-menu__link-text">Publicidades</span></a>
                </li>
                <li class="kt-menu__item {{ in_array($current_page, ['reports']) ? 'kt-menu__item--active' : '' }} " aria-haspopup="true" >
                    <a href="{{ route('reports') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-new-email"></i><span class="kt-menu__link-text">Contatos</span></a>
                </li>
                <li class="kt-menu__item {{ in_array($current_page, ['categories', 'add-category', 'edit-category', 'del-category']) ? 'kt-menu__item--active' : '' }} " aria-haspopup="true" >
                    <a href="{{ route('categories') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-list-2"></i><span class="kt-menu__link-text">Categorias</span></a>
                </li>
                <li class="kt-menu__item {{ in_array($current_page, ['tags', 'add-tag', 'edit-tag', 'del-tag']) ? 'kt-menu__item--active' : '' }} " aria-haspopup="true" >
                    <a href="{{ route('tags') }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-tags"></i><span class="kt-menu__link-text">Tags</span></a>
                </li>
                <li class="kt-menu__item {{ in_array($current_page, ['users', 'register', 'user-permission', 'del-user', 'edit-user']) ? 'kt-menu__item--active' : '' }} " aria-haspopup="true" >
                    <a href="{{ route('users') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-user-1"></i><span class="kt-menu__link-text">Usuários Sistema</span></a>
                </li>
                <li class="kt-menu__item {{ in_array($current_page, ['permissions', 'inactive-route', 'update-routes', 'del-route']) ? 'kt-menu__item--active' : '' }} " aria-haspopup="true" >
                    <a href="{{ route('permissions') }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-unlock"></i><span class="kt-menu__link-text">Permissões</span></a>
                </li>
                <li class="disabled kt-menu__item {{ in_array($current_page, ['notificacoes', 'notificacoes-view']) ? 'kt-menu__item--active' : '' }} " aria-haspopup="true" disabled>
                    <a href="{{ url('/notificacao') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-notification"></i><span class="kt-menu__link-text">Notificações</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>
<!-- end:: Aside -->
