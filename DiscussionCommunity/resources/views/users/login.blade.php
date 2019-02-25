@extends('app')
@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">
                @if(session()->has('user_login_failed'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('user_login_failed') }}
                    </div>
                @endif
                <form method="POST" action="/user/login" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email" class="control-label">用户名:</label>
                        <input id="email" name="email" type="text" class="form-control" placeholder="请输入邮箱地址">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">密码:</label>
                        <input id="password" name="password" class="form-control" placeholder="请填写密码">
                    </div>
                    <button type="submit" class="btn btn-success form-control">登录</button>
                </form>
            </div>
        </div>
    </div>
@stop