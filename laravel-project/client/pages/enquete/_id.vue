<template>
    <div v-if="enquete[0]">
        <h4>システムへのご意見を編集する。</h4>
        <div>
            <div>氏名</div>
            <input type="text" v-model="enquete[0].name">
            <div v-if="err_name" style="color:red;">{{ err_name }}</div>
        </div>
        <div>
            <div>性別</div>
            <input type="radio" id="radio_man" v-model="enquete[0].sex" value="1"><label for="radio_man">男性</label>
            <input type="radio" id="radio_woman" v-model="enquete[0].sex" value="2"><label for="radio_woman">女性</label>
            <div v-if="err_sex" style="color:red;">{{ err_sex }}</div>
        </div>
        <div>
            <div>年代</div>
            <select v-model="enquete[0].age">
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
            <input type="text" v-model="enquete[0].mail">
            <div v-if="err_mail" style="color:red;">{{ err_mail }}</div>
        </div>
        <div>
            <div>メール送信可否</div>
            <input type="checkbox" id="mail_send" name="mail_send" v-model="enquete[0].send_mail" value="1">
            <input type="hidden" id="mail_send" name="mail_send" v-model="enquete[0].send_mail" value="0">
            <label for="mail_send">メールマガジンを受け取る</label>
        </div>
        <div>
            <div>ご意見</div>
            <textarea v-model="enquete[0].comment"></textarea>
            <div v-if="err_comment" style="color:red;">{{ err_comment }}</div>
        </div>
        <div>
            <button @click="backTop()">戻る</button>
            <button @click="update()">保存する</button>
        </div>
    </div>
</template>

<script>
export default{
    name: 'EnqueteDetail',
    head: {
        //画面タイトル
        title: 'システムへのご意見｜PG研修',
    },
    data() {
        return {
            enquete_id: this.$route.params.id,
            enquete: [],
            //入力項目
            /*
            name: '',
            sex: '',
            age: '',
            mail: '',
            send_mail: '1',
            comment: '',
            */
            //apiのresponseからエラーメッセージを入れる
            err_name: '',
            err_sex: '',
            err_age: '',
            err_mail: '',
            err_comment: '',
        };
    },
    async mounted() {
    //async asyncData({ app, params }) {
        let enquete_id = this.enquete_id;
        //let enquete_id = params.id;
        //let result = {};
        this.$axios.get('http://localhost:8000/api/enquete/' + enquete_id)
		.then(({ data, headers }) => {
			this.enquete = data;
		});
        /*
        await app.$axios.get('http://localhost:8000/api/enquete/' + enquete_id).then(res => {
            //result = res;
            this.enquete = res.data.data;
            //this.name = res.data.name;
        })
        return result.data;
        */
    },
    methods: {
        backTop() {
            this.$router.push('/enquete');
        },
        async update() {
            await this.$axios.post('http://localhost:8000/api/enquete/update', {
                id: this.enquete_id,
                name: this.enquete[0].name,
                sex: this.enquete[0].sex,
                age: this.enquete[0].age,
                mail: this.enquete[0].mail,
                send_mail: this.enquete[0].send_mail,
                comment: this.enquete[0].comment,
            })
            //成功した時
            .then(res => {
                this.$router.push('/enquete');
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