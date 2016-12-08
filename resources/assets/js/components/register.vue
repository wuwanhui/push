<template>
    <div class='register-box'>
        <!-- 组件:用于显示提示信息 -->
        <Toast :toastshow.sync="toastshow" :toasttext="toasttext"></Toast>
        <validator name="validation_register1">
            <div class='register1'>
                <div class='pd05'>
                    <input @invalid="telonInvalid" initial="off" detect-change="off" v-model="telphone" id="telphone"
                           type="tel" class='phone-number' v-validate:telphone="['tel']" placeholder='请输入手机号码'>
                </div>
                <div class='pd05'>
                    <input @invalid="passwInvalid" v-model="passw1" initial="off" detect-change="off" id="passw1"
                           type="password" v-validate:passw1="['passw']" class='password-number' placeholder='请输入密码'>
                </div>
                <div class='pd05'>
                    <input @invalid="passwInvalid" v-model="passw2" initial="off" detect-change="off" id="passw2"
                           type="password" v-validate:passw2="['passw']" class='password-number' placeholder='请输入密码'>
                </div>
                <a class='greenBtn' v-on:click='register_user()'>下一步</a>
            </div>
        </validator>
    </div>
</template>
<script>
    //导入validation.js  此处的validation.js就是上文中validation.js的内容
    //    import validator from '../validator/validation';
    //导入显示提示信息的组件
    import Toast from '../components/toast.vue';
    export default{
        components: {
            //注册组件
            Toast
        },
        data(){
            return {
                telphone: '',//电话号码
                toastshow: false,//默认不现实提示信息
                toasttext: '',//提示信息内容
                passw1: '',//首次输入密码
                passw2: ''//再次输入密码
            }
        },
        methods: {
            //手机号验证失败时执行的方法
            telonInvalid(){
                //设置提示信息内容
                this.$set('toasttext', '手机不正确');
                //显示提示信息组件
                this.$set('toastshow', true);
            },
            //密码验证失败时执行的方法
            passwInvalid(){
                this.$set('toasttext', '只能输入6-20个字母、数字、下划线');
                this.$set('toastshow', true);
            },
            register_user(){
                var that = this;
                var telephones = that.$get('telphone');
                var pw1 = that.$get('passw1');
                var pw2 = that.$get('passw2')
                that.$validate(true, function () {
                    if (that.$validation_register1.invalid) {
                        //验证无效
                        that.$set('toasttext', '请完善表单');
                        that.$set('toastshow', true);
                    } else {
                        that.$set('toasttext', '验证通过');
                        that.$set('toastshow', true);
                        //验证通过做注册请求
                        /*that.$http.post('http://192.168.30.235:9999/rest/user/register',{'account':telephones,'pwd':pw1,'pwd2':pw2}).then(function(data){
                         if(data.data.code == '0'){
                         that.$set('toasttext','注册成功');
                         that.$set('toastshow',true);
                         }else{
                         that.$set('toasttext','注册失败');
                         that.$set('toastshow',true);
                         }
                         },function(error){
                         //显示返回的错误信息
                         that.$set('toasttext',String(error.status));
                         that.$set('toastshow',true);
                         })*/
                    }
                })

            }
        }
    }
</script>
<style>
    .register-box {
        padding: 10px;
    }

    .pd05 {
        margin-top: 5px;
    }

    .greenBtn {
        width: 173px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        background: red;
        color: #fff;
        margin-top: 5px;
    }
</style>