<?php

namespace QcloudIM;

/**
 * Class Constants
 */
class Constants
{
    /** @var string sdk版本号 */
    const SDK_VERSION = '0.1';
    /** @var string 调用baseuri */
    const SDK_BASE_URI = 'https://console.tim.qq.com/v4/';
    /** @var int 重试次数 */
    const SDK_RETRY_MAX_RETRIES = 1;

    /** @var string  昵称 长度不得超过500个字节 */
    const TAG_PROFILE_IM_NICK = 'Tag_Profile_IM_Nick';
    /** @var string  性别
     * Gender_Type_Unknown：没设置性别
     * Gender_Type_Female：女性
     * Gender_Type_Male：男性
     */
    const TAG_PROFILE_IM_GENDER = 'Tag_Profile_IM_Gender';
    /** @var int    生日 推荐用法：20190419 */
    const TAG_PROFILE_IM_BIRTHDAY = 'Tag_Profile_IM_BirthDay';
    /** @var string    所在地
     * 长度不得超过16个字节，推荐用法如下：
     * App 本地定义一套数字到地名的映射关系 后台实际保存的是4个 uint32_t 类型的数字
     * 其中第一个 uint32_t 表示国家
     * 第二个 uint32_t 用于表示省份
     * 第三个 uint32_t 用于表示城市
     * 第四个 uint32_t 用于表示区县
     */
    const TAG_PROFILE_IM_LOCATION = 'Tag_Profile_IM_Location';
    /** @var string    个性签名 长度不得超过500个字节 */
    const TAG_PROFILE_IM_SELFSIGNATURE = 'Tag_Profile_IM_SelfSignature';
    /** @var string    加好友验证方式
     * AllowType_Type_NeedConfirm：需要经过自己确认才能添加自己为好友
     * AllowType_Type_AllowAny：允许任何人添加自己为好友
     * AllowType_Type_DenyAny：不允许任何人添加自己为好友
     */
    const TAG_PROFILE_IM_ALLOWTYPE = 'Tag_Profile_IM_AllowType';
    /** @var int    语言 */
    const TAG_PROFILE_IM_LANGUAGE = 'Tag_Profile_IM_Language';
    /** @var string    头像URL 长度不得超过500个字节 */
    const TAG_PROFILE_IM_IMAGE = 'Tag_Profile_IM_Image';
    /** @var int    消息设置 标志位：Bit0：置0表示接收消息，置1则不接收消息 */
    const TAG_PROFILE_IM_MSGSETTINGS = 'Tag_Profile_IM_MsgSettings';
    /** @var string    管理员禁止加好友标识
     * AdminForbid_Type_None：默认值，允许加好友
     * AdminForbid_Type_SendOut：禁止该用户发起加好友请求
     */
    const TAG_PROFILE_IM_ADMINFORBIDTYPE = 'Tag_Profile_IM_AdminForbidType';
    /** @var int    等级
     * 通常一个 UINT-8 数据即可保存一个等级信息 您可以考虑拆分保存，从而实现多种角色的等级信息
     */
    const TAG_PROFILE_IM_LEVEL = 'Tag_Profile_IM_Level';
    /** @var int    角色
     * 通常一个 UINT-8 数据即可保存一个角色信息 您可以考虑拆分保存，从而保存多种角色信息
     */
    const TAG_PROFILE_IM_ROLE = 'Tag_Profile_IM_Role';
    /** @var array  获取所有标配资料字段 */
    const TAG_PROFILE_IM_ALL = [
        self::TAG_PROFILE_IM_NICK,
        self::TAG_PROFILE_IM_IMAGE,
        self::TAG_PROFILE_IM_GENDER,
        self::TAG_PROFILE_IM_BIRTHDAY,
        self::TAG_PROFILE_IM_LOCATION,
        self::TAG_PROFILE_IM_SELFSIGNATURE,
        self::TAG_PROFILE_IM_ALLOWTYPE,
        self::TAG_PROFILE_IM_LANGUAGE,
        self::TAG_PROFILE_IM_MSGSETTINGS,
        self::TAG_PROFILE_IM_ADMINFORBIDTYPE,
        self::TAG_PROFILE_IM_LEVEL,
        self::TAG_PROFILE_IM_ROLE,
    ];

    /** @var string 没设置性别 */
    const GENDER_TYPE_UNKNOWN = 'Gender_Type_Unknown';
    /** @var string 女性 */
    const GENDER_TYPE_FEMALE = 'Gender_Type_Female';
    /** @var string 男性 */
    const GENDER_TYPE_MALE = 'Gender_Type_Male';

    /** @var string 需要经过自己确认才能添加自己为好友 */
    const ALLOWTYPE_TYPE_NEEDCONFIRM = 'AllowType_Type_NeedConfirm';
    /** @var string 允许任何人添加自己为好友 */
    const ALLOWTYPE_TYPE_ALLOWANY = 'AllowType_Type_AllowAny';
    /** @var string 不允许任何人添加自己为好友 */
    const ALLOWTYPE_TYPE_DENYANY = 'AllowType_Type_DenyAny';

    /** @var string 默认值，允许加好友 */
    const ADMINFORBID_TYPE_NONE = 'AdminForbid_Type_None';
    /** @var string 禁止该用户发起加好友请求 */
    const ADMINFORBID_TYPE_SENDOUT = 'AdminForbid_Type_SendOut';

    /** @var string 群组形态，Private（即 Work，好友工作群） */
    const GROUP_TYPE_PUBLIC = 'Public';
    /** @var string 群组形态，Public（陌生人社交群） */
    const GROUP_TYPE_PRIVATE = 'Private';
    /** @var string 群组形态，ChatRoom（即 Meeting，会议群） */
    const GROUP_TYPE_CHATROOM = 'ChatRoom';
    /** @var string 群组形态，AVChatRoom（直播群） */
    const GROUP_TYPE_AV_CHATROOM = 'AVChatRoom';

    /** @var string 消息类型，TIMTextElem(文本消息) */
    const MSG_TYPE_TIM_TEXT = 'TIMTextElem';
    /** @var string 消息类型，TIMFaceElem(表情消息) */
    const MSG_TYPE_TIM_FACE = 'TIMFaceElem';
    /** @var string 消息类型，TIMLocationElem(位置消息) */
    const MSG_TYPE_TIM_LOCATION = 'TIMLocationElem';
    /** @var string 消息类型，TIMCustomElem(自定义消息) */
    const MSG_TYPE_TIM_CUSTOM = 'TIMCustomElem';

}
