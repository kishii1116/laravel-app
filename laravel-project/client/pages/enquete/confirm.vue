<template>
    <div>
        <table>
            <tr>
                <td>氏名</td>
                <td>{{ name }}</td>
            </tr>
            <tr>
                <td>性別</td>
                <td>{{ sex }}</td>
            </tr>
            <tr>
                <td>年代</td>
                <td>{{ age }}</td>
            </tr>
            <tr>
                <td>メールアドレス</td>
                <td>{{ mail }}</td>
            </tr>
            <tr>
                <td>メール送信可否</td>
                <td>{{ send_mail }}</td>
            </tr>
            <tr>
                <td>ご意見</td>
                <td>{{ comment }}</td>
            </tr>
        </table>
        <div>
            <button @click="browserBack()">戻る</button>
            <button @click="save()">この内容で送信する</button>
        </div>
    </div>
</template>

<script>
export default{
    name: 'EnqueteConfirm',
    head: {
        //画面タイトル
        title: 'システムへのご意見｜PG研修',
    },
    data() {
        return {
            name: this.$route.query.name,
            sex: this.$route.query.sex,
            age: this.$route.query.age,
            mail: this.$route.query.mail,
            send_mail: this.$route.query.send_mail,
            comment: this.$route.query.comment,
        };
    },
    methods: {
        browserBack() {
            this.$router.go(-1);
        },
        async save() {
            await this.$axios.post('http://localhost:8000/api/enquete/save', {
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

            })
        }
    }
}
</script>