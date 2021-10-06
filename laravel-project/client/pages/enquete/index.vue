<template>
    <div>
        <h4>アンケート管理システム</h4>
        
        <div>
            氏名
            <input type="text" v-model="search.name">
            年代
            <select v-model="search.age">
                <option value="">選択してください</option>
                <option value="10">10代以下</option>
                <option value="20">20代</option>
                <option value="30">30代</option>
                <option value="40">40代</option>
                <option value="50">50代</option>
                <option value="60">60代以上</option>
            </select>
            性別
            <input type="radio" id="radio_all" v-model="search.sex" value=""><label for="radio_all">すべて</label>
            <input type="radio" id="radio_man" v-model="search.sex" value="1"><label for="radio_man">男性</label>
            <input type="radio" id="radio_woman" v-model="search.sex" value="2"><label for="radio_woman">女性</label>
        </div>
        <div>
            登録日
            <input type="date" v-model="search.start">
            〜
            <input type="date" v-model="search.end">
            メール送信許可
            <input type="checkbox" id="mail_send" name="mail_send" v-model="search.send_mail" value="1">
            <input type="hidden" id="mail_send" name="mail_send" v-model="search.send_mail" value="">
        </div>
        <div>
            キーワード
            <input type="text" v-model="search.keyword">
        </div>
        <div>
            <button @click="resetSearchContents()">リセット</button>
            <button class="btn btn-primary" @click="getEnqueteList()">検索する</button>
        </div>
        
        <table>
            <tbody>
                <tr>
                    <th>日時</th>
                    <th>氏名</th>
                    <th>性別</th>
                    <th>年代</th>
                    <th>メールアドレス</th>
                    <th>詳細を見る</th>
                </tr>
                <tr v-for="data in dataList" :key="data.id">
                    <td>
                        {{ data.create_dt | displayDatetime }}
                    </td>
                    <td>
                        {{ data.name }}
                    </td>
                    <td>
                        {{ data.sex | displaySex }}
                    </td>
                    <td>
                        {{ data.age | displayAge }}
                    </td>
                    <td>
                        {{ data.mail }}
                    </td>
                    <td>
                        <button @click="showDetail(data.id)">Link</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import moment from "moment";

export default{
    name: 'Enquete',
    head: {
        //画面タイトル
        title: 'アンケート管理システム｜PG研修',
    },
    data() {
        return {
            //入力項目
            dataList: [],
            search : {
                name: '',
                sex: '',
                age: '',
                start: '',
                end: '',
                send_mail: '',
                keyword: '',
            }
        };
    },
    /*
    async created() {
		await this.getEnqueteList();
	},
    */
	async mounted() {
		await this.getEnqueteList();
	},
	methods: {
		async getEnqueteList() {
            /*
            await this.$axios.get('http://localhost:8000/api/enquete/list').then(res => {
                this.dataList = res.data.data
            })
            */
			await this.$axios.post('http://localhost:8000/api/enquete/list',this.search)
				.then(({ data, headers }) => {
					this.dataList = data;
				});
		},
        showDetail($id) {
            this.$router.push('/enquete/'+$id);
        },
        resetSearchContents() {
            this.search.name = '';
            this.search.sex = '';
            this.search.age = '';
            this.search.start = '';
            this.search.end = '';
            this.search.send_mail = '';
            this.search.keyword = '';
        }
    },
    filters: {
        displaySex: function(sex) {
            let val = '';
            switch(sex) {
                case '1': val = '男性'; break;
                case '2': val = '女性'; break;
            }
            return val;
        },
        displayAge: function(age) {
            let val = '';
            switch(age) {
                case '10': val = '10代以下'; break;
                case '20': val = '20代'; break;
                case '30': val = '30代'; break;
                case '40': val = '40代'; break;
                case '50': val = '50代'; break;
                case '60': val = '60代以上'; break;
            }
            return val;
        },
        displayDatetime: function(datetime) {
            return moment(datetime).format("YYYY年MM月DD日 hh:mm:ss");
        },
    },
}
</script>