@php
    $active_tab = Route::currentRouteName();
@endphp
{{   Route::currentRouteName() }}
<ul class="nav justify-content-center tabs" id="admin_tab">
    <li class="nav-item">
        <a
            href="{{ ajaxUrl(route('admin.admin_edit',['id'=>$obj->id])) }}"
            class="nav-link @if($active_tab == 'admin.admin_edit') active disabled @endif ">Admin User</a>
    </li>
     <li class="nav-item">
        <a
            href="{{ ajaxUrl(route('admin.admin_permissions',['id'=>$obj->id])) }}"
            class="nav-link @if($active_tab == 'admin.admin_permissions') active disabled @endif ">Permissions</a>
    </li>
</ul>
 