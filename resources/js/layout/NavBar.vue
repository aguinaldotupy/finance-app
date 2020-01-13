<template>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"/></a>
            </li>
        </ul>

<!--        &lt;!&ndash; SEARCH FORM &ndash;&gt;-->
<!--        <form class="form-inline ml-3">-->
<!--            <div class="input-group input-group-sm">-->
<!--                <input aria-label="Search" class="form-control form-control-navbar" placeholder="Search" type="search">-->
<!--                <div class="input-group-append">-->
<!--                    <button class="btn btn-navbar" type="submit">-->
<!--                        <i class="fas fa-search"/>-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
<!--            <li class="nav-item dropdown">-->
<!--                <a class="nav-link" data-toggle="dropdown" href="#">-->
<!--                    <i class="far fa-comments"/>-->
<!--                    <span class="badge badge-danger navbar-badge">3</span>-->
<!--                </a>-->
<!--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">-->
<!--                    <a class="dropdown-item" href="#">-->
<!--                        &lt;!&ndash; Message Start &ndash;&gt;-->
<!--                        <div class="media">-->
<!--                            <img alt="User Avatar" class="img-size-50 mr-3 img-circle" src="">-->
<!--                            <div class="media-body">-->
<!--                                <h3 class="dropdown-item-title">-->
<!--                                    Brad Diesel-->
<!--                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"/></span>-->
<!--                                </h3>-->
<!--                                <p class="text-sm">Call me whenever you can...</p>-->
<!--                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"/> 4 Hours Ago</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; Message End &ndash;&gt;-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#">-->
<!--                        &lt;!&ndash; Message Start &ndash;&gt;-->
<!--                        <div class="media">-->
<!--                            <img alt="User Avatar" class="img-size-50 img-circle mr-3" src="">-->
<!--                            <div class="media-body">-->
<!--                                <h3 class="dropdown-item-title">-->
<!--                                    John Pierce-->
<!--                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"/></span>-->
<!--                                </h3>-->
<!--                                <p class="text-sm">I got your message bro</p>-->
<!--                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"/> 4 Hours Ago</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; Message End &ndash;&gt;-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#">-->
<!--                        &lt;!&ndash; Message Start &ndash;&gt;-->
<!--                        <div class="media">-->
<!--                            <img alt="User Avatar" class="img-size-50 img-circle mr-3" src="">-->
<!--                            <div class="media-body">-->
<!--                                <h3 class="dropdown-item-title">-->
<!--                                    Nora Silvester-->
<!--                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"/></span>-->
<!--                                </h3>-->
<!--                                <p class="text-sm">The subject goes here</p>-->
<!--                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"/> 4 Hours Ago</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; Message End &ndash;&gt;-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item dropdown-footer" href="#">See All Messages</a>-->
<!--                </div>-->
<!--            </li>-->
<!--            &lt;!&ndash; Notifications Dropdown Menu &ndash;&gt;-->
<!--            <li class="nav-item dropdown">-->
<!--                <a class="nav-link" data-toggle="dropdown" href="#">-->
<!--                    <i class="far fa-bell"/>-->
<!--                    <span class="badge badge-warning navbar-badge">15</span>-->
<!--                </a>-->
<!--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">-->
<!--                    <span class="dropdown-item dropdown-header">15 Notifications</span>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#">-->
<!--                        <i class="fas fa-envelope mr-2"/> 4 new messages-->
<!--                        <span class="float-right text-muted text-sm">3 mins</span>-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#">-->
<!--                        <i class="fas fa-users mr-2"/> 8 friend requests-->
<!--                        <span class="float-right text-muted text-sm">12 hours</span>-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#">-->
<!--                        <i class="fas fa-file mr-2"/> 3 new reports-->
<!--                        <span class="float-right text-muted text-sm">2 days</span>-->
<!--                    </a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item dropdown-footer" href="#">See All Notifications</a>-->
<!--                </div>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" data-slide="true" data-widget="control-sidebar" href="#">-->
<!--                    <i class="fas fa-th-large"/>-->
<!--                </a>-->
<!--            </li>-->
            <li class="nav-item">
                <a @click="logout" class="dropdown-item btn btn-dark">
                    Sair
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
</template>

<script>
    export default {
        name: "NavBar",
        methods: {
            logout(){
                axios.post(route('logout')).then(() => {
                    window.location = '/login';
                }).catch(error => {
                    toastError('Não foi possível efetuar o logout')
                });
            }
        }
    }
</script>

<style scoped>

</style>
