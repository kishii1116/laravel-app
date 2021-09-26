<template>
    <div>
        <h4>アンケート管理システム</h4>
        
        <div>
            氏名
            <input type="text" v-model="search_name">
            年代
            <select v-model="search_age">
                <option value="">選択してください</option>
                <option value="10">10代以下</option>
                <option value="20">20代</option>
                <option value="30">30代</option>
                <option value="40">40代</option>
                <option value="50">50代</option>
                <option value="60">60代以上</option>
            </select>
            性別
            <input type="radio" id="radio_all" v-model="search_sex" value=""><label for="radio_all">すべて</label>
            <input type="radio" id="radio_man" v-model="search_sex" value="1"><label for="radio_man">男性</label>
            <input type="radio" id="radio_woman" v-model="search_sex" value="2"><label for="radio_woman">女性</label>
        </div>
        <div>
            登録日
            <input type="date" v-model="search_start">
            〜
            <input type="date" v-model="search_end">
            メール送信許可
            <input type="checkbox" id="mail_send" name="mail_send" v-model="search_send_mail" value="1">
            <input type="hidden" id="mail_send" name="mail_send" v-model="search_send_mail" value="">
        </div>
        <div>
            キーワード
            <input type="text" v-model="search_keyword">
        </div>
        <div>
            <button>リセット</button>
            <button class="btn btn-primary">検索する</button>
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
            search_name: '',
            search_sex: '',
            search_age: '',
            search_start: '',
            search_end: '',
            search_send_mail: '',
            search_keyword: '',
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
			await this.$axios.get('http://localhost:8000/api/enquete/list')
				.then(({ data, headers }) => {
					this.dataList = data;
				});
		},
        showDetail($id) {
            this.$router.push('/enquete/'+$id);
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