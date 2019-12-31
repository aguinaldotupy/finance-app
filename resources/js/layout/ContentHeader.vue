<!--suppress CheckTagEmptyBody -->
<template>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                        <h1>{{ title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <slot></slot>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid header-->
    </section>
    <!-- End Content Header (Page header) -->
</template>

<script>
    export default {
        name: "ContentHeader",
        props: {
            title: {
                type: String,
                required: false,
                default: "Título"
            }
        }
    }
</script>

<style scoped>

</style>
