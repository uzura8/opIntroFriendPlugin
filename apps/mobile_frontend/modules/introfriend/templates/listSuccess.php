<?php
op_mobile_page_title(__('Introductory essay from %my_friend%'));

echo '<center>';
echo pager_total($pager);
echo '</center>';

$list = array();
foreach ($pager->getResults() as $i => $introFriend)
{
  $member = $introFriend->getMember_2();
  $list[$i] = __('%Nickname%').' :<br>'
          .link_to($member->getName(), '@member_profile?id='.$member->getId()).'<br><br>'
          .__('Introductory essay').' :<br>'
          .nl2br($introFriend->getContent());

  $options = array('from' => 'list');
  if ($id == $sf_user->getMemberId() || $member->getId() == $sf_user->getMemberId())
  {
    $list[$i] .=  '<br><br>';
    if ($member->getId() == $sf_user->getMemberId())
    {
      $list[$i] .= '['.link_to(__('Edit'), 'obj_member_introfriend', $introFriend->getMember()).']';
      $options['target'] = 'my';
      $options['sf_subject'] = $introFriend->getMember();
    }
    else
    {
      $options['target'] = 'friend';
      $options['sf_subject'] = $introFriend->getMember_2();
    }
    $list[$i] .= '['.link_to(__('Delete'), 'obj_introfriend_delete', $options).']';
  }
}
$options = array(
  'border' => true,
);
include_list_box('introFriend', $list, $options);

echo op_include_pager_navigation($pager, '@obj_introfriend?id='.$id.'&page=%d', array('is_total' => false));
