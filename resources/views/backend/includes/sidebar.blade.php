<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <a href="{{route('backend.dashboard')}}">
            <img class="sidebar-brand-full" src="{{asset('img/winx-logo.png')}}" height="46" alt="{{ app_name() }}">
            <img class="sidebar-brand-narrow" src="{{asset('img/backend-logo-square.jpg')}}" height="46" alt="{{ app_name() }}">
        </a>
        
    </div>
  
    <div style="width: 220px; height:76px border-radius: 12px;
    background: var(--transparent-grey-8, rgba(145, 158, 171, 0.08)); 
    display: flex;
    border-radius: 12px;

padding: 16px 20px;
justify-content: center;
align-items: center;
margin:auto;
margin-top:16px !important;
color: var(--text-light-primary, #212B36);
"> 
 <div class="avatar avatar-md " style="    margin-right: 16px;">
  <img class="avatar-img" src="{{ asset(auth()->user()->avatar)  ?? ''}}" alt="{{ asset(auth()->user()->name) }}">

</div>
<div>   <p>{{ Auth::user()->name }}</p></div>

</div>
    {!! $admin_sidebar->asUl( ['class' => 'sidebar-nav', 'data-coreui'=>'navigation', 'data-simplebar'], ['class' => 'nav-group-items'] ) !!}

    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>