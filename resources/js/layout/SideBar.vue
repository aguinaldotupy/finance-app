<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a class="brand-link" href="/">
            <img
                src="https://placehold.it/160x160/c98959/ffffff/&text=WA"
                :alt="app_name"
                class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">{{ app_name }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img alt="User Image" class="img-circle elevation-2" src="https://placehold.it/160x160/c98959/ffffff/&text=WA">
                </div>
                <div class="info">
                    <a :href="vueRoute('profile.edit', auth.id)" class="d-block">{{ auth.name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-accordion="false" data-widget="treeview" role="menu">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                        <a class="nav-link" href="#">
                            <i class="nav-icon fas fa-tachometer-alt"/>
                            <p> Dashboard
                                <i class="right fas fa-angle-left"/>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="nav-icon fas icon ion-md-bookmark"/>
                            <p> Categorias</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a :href="vueRoute('transactions.index')" class="nav-link">
                            <i class="nav-icon fas fa-money-bill-alt"/>
                            <p> Transações</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a :href="vueRoute('transactions.calendar')" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"/>
                            <p> Calendário</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
    export default {
        name: "SideBar",
    }
</script>

<style scoped>

</style>
