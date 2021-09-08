<template>
    <div>
        <h4>システムへのご意見をお聞かせください。</h4>
        <div>
            <div>氏名</div>
            <input type="text">
        </div>
        <div>
            <div>性別</div>
            <input type="radio" id="radio_man" value="1"><label for="radio_man">男性</label>
            <input type="radio" id="radio_woman" value="2"><label for="radio_woman">女性</label>
        </div>
        <div>
            <div>年代</div>
            <select>
                <option value="">選択してください</option>
                <option value="10">10代以下</option>
                <option value="20">20代</option>
                <option value="30">30代</option>
                <option value="40">40代</option>
                <option value="50">50代</option>
                <option value="60">60代以上</option>
            </select>
        </div>
        <div>
            <div>メールアドレス</div>
            <input type="text">
        </div>
        <div>
            <div>メール送信可否</div>
            <input type="checkbox" id="mail_send">
            <label for="mail_send">メールマガジンを受け取る</label>
        </div>
        <div>
            <div>ご意見</div>
            <textarea></textarea>
        </div>
        <div>
            <button>入力内容を確認する</button>
        </div>
    </div>
</template>

<script>
export default{
    async asyncData({app}){
    const data = await app.$axios.$get('http://localhost:8000/api/')
    return {data};
    }
}
</script>