<?php
if(isset($_POST['question'])){
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$postdata = array(
  "model"=> "text-davinci-003",
  "prompt"=> $_POST['question'],
  "temperature"=> 0.7,
  "max_tokens"=> 256,
  "top_p"=> 1,
  "frequency_penalty"=> 0,
  "presence_penalty"=> 0
);
$postdata = json_encode($postdata);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization:Bearer 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';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
echo "<pre>";
$msg = json_decode($result,true);
$msg = $msg['choices'][0]['text'];
// print_r($msg->choices[0]->text);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
}
            
?>
<form method="post">
	<label>Question</label>
	<textarea name="question"></textarea>
	<input type="submit" name="submit">
</form>
 <?php if(isset($msg)){?>
<label>Answer : </label>
<p><?php echo $msg;?></p>
<?php }?>






