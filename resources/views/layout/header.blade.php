<div class="blog-masthead">
    <div class="container">
        @include('layout.nav')

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <div>
                    <img src="{{\Auth::user()->avatar}}" alt="" class="img-rounded" style="border-radius:500px; height: 30px">
                    <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      {{ \Auth::user()->name }}
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/user/{{\Auth::id()}}">我的主页</a></li>
                        <li><a href="/user/me/setting">个人设置</a></li>
                        <li><a href="/logout">登出</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
