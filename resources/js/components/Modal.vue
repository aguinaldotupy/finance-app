<template>
    <div class="modal-mask">
        <div class="modal-dialog modal-lg modal-light-dark">
            <div class="modal-container">

                <div class="modal-header">
                    <slot name="header">
                        default header
                    </slot>
                    <button type="button" class="close" aria-hidden="true" @click="close">×</button>
                </div>

                <div class="modal-body">
                    <slot name="body">
                        default body
                    </slot>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-default float-left" @click="close">
                        Fechar
                    </button>
                    <slot name="footer">
                        default footer
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Modal",
        methods: {
            close(){
                this.$emit('close');
            }
        }
    }
</script>

<style lang="scss">
    .modal-light-dark {
        .modal-header {
            background-color: #38414aeb;
        }

        .close {
            color: white;
        }
    }

    .modal-mask {
        position: absolute;
        /*position: fixed;*/
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /*background-color: rgba(0, 0, 0, .5);*/
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 0.3rem;
        outline: 0;
        overflow-y: initial
    }

    .modal-header h3 {
        margin-top: 0;
        color: #ffffff;
    }

    .modal-body {
        margin: 20px 0;
        overflow-y: auto;
    }

    .modal-default-button {
        float: right;
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>
