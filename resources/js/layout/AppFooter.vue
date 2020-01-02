<template>
    <footer class="main-footer text-sm">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> {{ version }}
        </div>
        <strong>Copyright &copy; 2019-{{ year }} <a href="#">{{ app_name }}</a>.</strong> All rights reserved.
    </footer>
</template>

<script>
    export default {
        name: "AppFooter",
        data(){
            return {
                version: process.env.MIX_APP_VERSION,
                year: momentJS().year()
            }
        }
    }
</script>

<style scoped>

</style>
