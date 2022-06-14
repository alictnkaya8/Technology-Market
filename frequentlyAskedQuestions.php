<form action="index.php?pageNo=15" method="post">
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="100" bgcolor="#FF9900">
            <td align="left"><h2 style="color:white;">SIK SORULAN SORULAR</h2></td>
        </tr>
        <tr height="50">
            <td align="left" style="border-bottom: 1px dashed #CCCCCC;">&nbsp;Aklınıza takılabileceğini düşündüğümüz soruların cevaplarını bu sayfada cevapladık. Fakat farklı bir sorunuz varsa lütfen iletişim alanından bize iletiniz.</td>
        </tr>
        <tr>
            <td>
                <?php
                    $questionQuery = $db->prepare("SELECT * FROM questions");
                    $questionQuery->execute();
                    $questionCount = $questionQuery->rowCount();
                    $questions = $questionQuery->fetchAll(PDO::FETCH_ASSOC);

                    foreach($questions as $question):
                ?>
                <div>
                    <div id="<?php echo $question['id']; ?>" class="QuestionArea" onclick="$.showAnswer(<?php echo $question['id']; ?>)"><?php echo $question["question"]; ?></div>
                    <div class="AnswerArea" style="display: none;"><?php echo $question["answer"]; ?></div>
                </div>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>
</form>