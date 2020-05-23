// 실시간으로 댓글을 올라갈수 있도록 만들어줌
// 댓글등록
$(document).ready(function() {
    $("#repBtn").click(function() {
        //repBtn클래스트 클릭 시 post형식으로 replyOK.php에 데이터 전송
        $.post("replyOk.php", {
            bno:$(".bno").val(), 
            datUser:$(".datUser").val(), 
            datPw:$(".datPw").val(), 
            content:$(".replyContent").val(), 
        },
        function(data, success) {
            if(success=="success") {
                $(".replyView").html(data);
                alert("댓글이 작성되었습니다.");
            }else {
                alert("댓글작성이 실패되었습니다.");
            }
        
        });
    });
// 댓글 수정
$(".datEditBtn").click(function() {
    // closest - 선택자 가장 가까운 곳
    // closest.find() - 가장 가까운 상위에서 아래로 내려가서 찾는 법
    var obj = $(this).closest(".dapLo").find(".datEdit");
    obj.dialog({
        modal:true, 
        width:650, 
        height:200, 
        title:"댓글 수정"});
});

// 댓글 삭제
$(".datDelBtn").click(function() {
    var obj = $(this).closest(".dapLo").find(".datDelete");
    obj.dialog({
        modal:true, 
        width:400, 
        title:"댓글 삭제확인!!"});
});

});