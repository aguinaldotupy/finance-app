<template>
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img alt="User profile picture"
                             class="profile-user-img img-fluid img-circle"
                             src="">
                    </div>

                    <h3 class="profile-username text-center">{{ user.name }}</h3>

                    <p class="text-muted text-center">Software Engineer</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Followers</b> <a class="float-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                            <b>Following</b> <a class="float-right">543</a>
                        </li>
                        <li class="list-group-item">
                            <b>Friends</b> <a class="float-right">13,287</a>
                        </li>
                    </ul>

                    <a class="btn btn-primary btn-block" href="#"><b>Follow</b></a>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#timeline">Timeline</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings">Settings</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="timeline">
                            <!-- The timeline -->
                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-danger">10 Feb. 2014</span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-envelope bg-primary"/>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"/> 12:05</span>

                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                        <div class="timeline-body">
                                            Nov
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-primary btn-sm" href="#">Read more</a>
                                            <a class="btn btn-danger btn-sm" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-user bg-info"/>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"/> 5 mins ago</span>

                                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                        </h3>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-comments bg-warning"/>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"/> 27 mins ago</span>

                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                        <div class="timeline-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-warning btn-flat btn-sm" href="#">View comment</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-success">3 Jan. 2014</span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="far fa-clock bg-gray"/>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <form @submit.prevent="update" class="form-horizontal" method="POST">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="inputName">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputName" name="name" placeholder="Name" type="text" v-model="user.name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="inputEmail">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputEmail" name="email" placeholder="Email" type="email" v-model="user.email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button class="btn btn-success" type="submit">Gravar</button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</template>

<script>
    import scroll from '../scrollTo';

    export default {
        name: "Profile",
        data(){
            return {
                user: {}
            }
        },
        mounted() {
            this.getUser();
        },
        methods: {
            getUser(){
                if(localStorage.getItem('user')){
                    this.user = JSON.parse(localStorage.getItem('user'));
                } else {
                    this.callUser()
                }
            },
            callUser(){
                axios.get(route('api.user')).then(({data}) => {
                    this.user = data
                }).catch(error => {
                    console.log(error)
                });
            },
            update(){
                this.persistSubmit('put', route('api.user.update', this.user.id), this.user, false);
                scroll('body');
                localStorage.setItem('user', JSON.stringify(this.user));
            }
        }
    }
</script>

<style scoped>

</style>
