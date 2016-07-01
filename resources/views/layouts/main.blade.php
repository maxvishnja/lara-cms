<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        @section('title')
        @show
    </title>
    @include('layouts/blocks.head')
    @stack('styles')
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentellela Alela!</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="/{{ Sentry::getUser()->avatar }}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Добро пожаловать,</span>
                        <h2>{{ Sentry::getUser()->first_name }} {{ Sentry::getUser()->last_name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
                <div class="clearfix"></div>
                <br/>

                <!-- sidebar menu -->
                @include('layouts/blocks.sidebar-menu')
                        <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    @if (Sentry::check())
                        <a data-toggle="tooltip" data-placement="top" title="{{ trans('navigation.top_settings') }}">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a href="{{ route('sentinel.logout') }}" data-toggle="tooltip" data-placement="top"
                           title="{{ trans('navigation.top_logout') }}">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    @endif
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        @if (Sentry::check())
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false">
                                    <img src="/{{ Sentry::getUser()->avatar }}"
                                         alt="">{{ Sentry::getUser()->first_name }} {{ Sentry::getUser()->last_name }}
                                    <span class=" fa fa-angle-down"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-usermenu pull-right">

                                    <li><a href="{{ route('sentinel.profile.show') }}"><i
                                                    class="fa fa-user pull-right"></i> {{ trans('navigation.top_profile') }}
                                        </a></li>
                                    <li><a href="#"><i
                                                    class="fa fa-cog pull-right"></i> {{ trans('navigation.top_settings') }}
                                        </a></li>
                                    <li><a href="{{ route('sentinel.logout') }}"><i
                                                    class="fa fa-sign-out pull-right"></i> {{ trans('navigation.top_logout') }}
                                        </a></li>
                                </ul>

                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('page-title')
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        @section('title')
                        @show
                    </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12  col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- compose -->
<div class="compose col-md-6 col-xs-12">
    <div class="compose-header">
        New Message
        <button type="button" class="close compose-close">
            <span>×</span>
        </button>
    </div>

    <div class="compose-body">
        <div id="alerts"></div>

        <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b
                            class="caret"></b></a>
                <ul class="dropdown-menu">
                </ul>
            </div>

            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i
                            class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a data-edit="fontSize 5">
                            <p style="font-size:17px">Huge</p>
                        </a>
                    </li>
                    <li>
                        <a data-edit="fontSize 3">
                            <p style="font-size:14px">Normal</p>
                        </a>
                    </li>
                    <li>
                        <a data-edit="fontSize 1">
                            <p style="font-size:11px">Small</p>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i
                            class="fa fa-align-right"></i></a>
                <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                <div class="dropdown-menu input-append">
                    <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                    <button class="btn" type="button">Add</button>
                </div>
                <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i
                            class="fa fa-picture-o"></i></a>
                <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage"/>
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
            </div>
        </div>

        <div id="editor" class="editor-wrapper"></div>
    </div>

    <div class="compose-footer">
        <button id="send" class="btn btn-sm btn-success" type="button">Send</button>
    </div>
</div>
<!-- /compose -->

@include('layouts/blocks.footer')

@stack('scripts')
<script>
    $(document).ready(function () {
        $('.confirm').on('click', function () {
            $.confirm({
                title: '{{ trans('actions.confirm-title') }}',
                content: ' ',
                confirmButton: '{{ trans('actions.confirm-but-yes') }}',
                cancelButton: '{{ trans('actions.confirm-but-no') }}',
                confirm: function () {
                    restfulize();
                }
            });
        });
    });
</script>
</body>
</html>