<template>
    <div>
        <h4>システムへのご意見をお聞かせください。</h4>
        <div>
            <div>氏名</div>
            <input type="text" v-model="name">
            <div v-if="err_name" style="color:red;">{{ err_name }}</div>
        </div>
        <div>
            <div>性別</div>
            <input type="radio" id="radio_man" v-model="sex" value="1"><label for="radio_man">男性</label>
            <input type="radio" id="radio_woman" v-model="sex" value="2"><label for="radio_woman">女性</label>
            <div v-if="err_sex" style="color:red;">{{ err_sex }}</div>
        </div>
        <div>
            <div>年代</div>
            <select v-model="age">
                <option value="">選択してください</option>
                <option value="10">10代以下</option>
                <option value="20">20代</option>
                <option value="30">30代</option>
                <option value="40">40代</option>
                <option value="50">50代</option>
                <option value="60">60代以上</option>
            </select>
            <div v-if="err_age" style="color:red;">{{ err_age }}</div>
        </div>
        <div>
            <div>メールアドレス</div>
            <input type="text" v-model="mail">
            <div v-if="err_mail" style="color:red;">{{ err_mail }}</div>
        </div>
        <div>
            <div>メール送信可否</div>
            <input type="checkbox" id="mail_send" v-model="send_mail">
            <label for="mail_send">メールマガジンを受け取る</label>
        </div>
        <div>
            <div>ご意見</div>
            <textarea v-model="comment"></textarea>
            <div v-if="err_comment" style="color:red;">{{ err_comment }}</div>
        </div>
        <div>
            <button @click="save()">入力内容を確認する</button>
        </div>
    </div>
</template>

<script>
export default{
    name: 'Enquete',
    head: {
        //画面タイトル
        title: 'システムへのご意見｜PG研修',
    },
    data() {
        return {
            //入力項目
            name: '',
            sex: '',
            age: '',
            mail: '',
            send_mail: '',
            comment: '',
            //apiのresponseからエラーメッセージを入れる
            err_name: '',
            err_sex: '',
            err_age: '',
            err_mail: '',
            err_comment: '',
        };
    },
    methods: {
        async save() {
            await this.$axios.post('http://localhost:8000/api/enquete', {
                name: this.name,
                sex: this.sex,
                age: this.age,
                mail: this.mail,
                send_mail: this.send_mail,
                comment: this.comment,
            })
            //成功した時
            .then(res => {
                this.$router.push('/enquete/done');
            })
            //失敗した時
            .catch(e => {
                //エラーをリセット
                this.err_name = '';
                this.err_sex = '';
                this.err_age = '';
                this.err_mail = '';
                this.err_comment = '';
                //入力チェックで引っかかったら、エラーメッセージを入れる
                //ひっかからなかったら、オブジェクトができないた、if
                if( e.response.data.errors.name ) {
                    this.err_name = e.response.data.errors.name[0];
                }
                if( e.response.data.errors.sex ) {
                    this.err_sex = e.response.data.errors.sex[0];
                }
                if( e.response.data.errors.age ) {
                    this.err_age = e.response.data.errors.age[0];
                }
                if( e.response.data.errors.mail ) {
                    this.err_mail = e.response.data.errors.mail[0];
                }
                if( e.response.data.errors.comment ) {
                    this.err_comment = e.response.data.errors.comment[0];
                }
            })
        }
    }
}
</script>