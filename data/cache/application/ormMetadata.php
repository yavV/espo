<?php
return array (
  'Attachment' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'type' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'size' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'sourceId' => 
      array (
        'type' => 'varchar',
        'len' => 36,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'contents' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'role' => 
      array (
        'type' => 'varchar',
        'len' => 36,
      ),
      'global' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'parentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'parent',
        'notNull' => false,
      ),
      'parentType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'parent',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'parentName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'relatedId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'related',
        'notNull' => false,
      ),
      'relatedType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'related',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'relatedName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
    ),
    'relations' => 
    array (
      'related' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'relatedId',
      ),
      'parent' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'parentId',
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'parent' => 
      array (
        'columns' => 
        array (
          0 => 'parentType',
          1 => 'parentId',
        ),
      ),
    ),
  ),
  'AuthToken' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'token' => 
      array (
        'type' => 'varchar',
        'len' => '36',
        'index' => true,
      ),
      'hash' => 
      array (
        'type' => 'varchar',
        'len' => 150,
        'index' => true,
      ),
      'userId' => 
      array (
        'dbType' => 'varchar',
        'len' => '36',
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'ipAddress' => 
      array (
        'type' => 'varchar',
        'len' => '36',
      ),
      'lastAccess' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'userName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'user',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'portalId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'portalName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'portal',
        'foreign' => 'name',
      ),
    ),
    'relations' => 
    array (
      'portal' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Portal',
        'key' => 'portalId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'user' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'userId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'token' => 
      array (
        'columns' => 
        array (
          0 => 'token',
          1 => 'deleted',
        ),
      ),
    ),
  ),
  'Currency' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'rate' => 
      array (
        'type' => 'float',
        'notNull' => false,
      ),
    ),
    'relations' => 
    array (
    ),
  ),
  'Email' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'subject' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'fromName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'fromString' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'replyToString' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'from' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'to' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'cc' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'bcc' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'replyTo' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'personStringData' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'isRead' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => true,
      ),
      'isNotRead' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => false,
      ),
      'isReplied' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'isNotReplied' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => false,
      ),
      'isImportant' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => false,
      ),
      'inTrash' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => false,
      ),
      'folderId' => 
      array (
        'dbType' => 'varchar',
        'len' => 255,
        'type' => 'foreignId',
        'notStorable' => true,
        'default' => '',
        'index' => 'folder',
        'notNull' => false,
      ),
      'isUsers' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => false,
      ),
      'nameHash' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'typeHash' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'idHash' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'messageId' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'messageIdInternal' => 
      array (
        'type' => 'varchar',
        'len' => 300,
      ),
      'emailAddress' => 
      array (
        'type' => 'base',
        'notStorable' => true,
      ),
      'bodyPlain' => 
      array (
        'type' => 'text',
      ),
      'body' => 
      array (
        'type' => 'text',
      ),
      'isHtml' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'default' => 'Archived',
        'len' => 255,
      ),
      'hasAttachment' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'dateSent' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'deliveryDate' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'isSystem' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'isJustSent' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => false,
      ),
      'isBeingImported' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => false,
      ),
      'folderName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'fromEmailAddressId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'fromEmailAddressName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'fromEmailAddress',
        'foreign' => 'name',
      ),
      'toEmailAddressesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'toEmailAddressesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'ccEmailAddressesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'ccEmailAddressesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'parentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'parent',
        'notNull' => false,
      ),
      'parentType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'parent',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'parentName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'sentById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'sentByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'sentBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'repliedId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'repliedName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'replied',
        'foreign' => 'name',
      ),
      'repliesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'repliesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersColumns' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'assignedUsersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'assignedUsersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'inboundEmailsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'inboundEmailsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailAccountsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailAccountsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'accountName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'account',
        'foreign' => 'name',
      ),
      'bccEmailAddressesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'bccEmailAddressesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsTypes' => 
      array (
        'type' => 'jsonObject',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'account' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Account',
        'key' => 'accountId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'emailAccounts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'EmailAccount',
        'relationName' => 'emailEmailAccount',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'emailId',
          1 => 'emailAccountId',
        ),
        'foreign' => 'emails',
      ),
      'inboundEmails' => 
      array (
        'type' => 'manyMany',
        'entity' => 'InboundEmail',
        'relationName' => 'emailInboundEmail',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'emailId',
          1 => 'inboundEmailId',
        ),
        'foreign' => 'emails',
      ),
      'bccEmailAddresses' => 
      array (
        'type' => 'manyMany',
        'entity' => 'EmailAddress',
        'foreignKey' => 'id',
        'foreign' => NULL,
        'midKeys' => 
        array (
          0 => 'emailId',
          1 => 'emailAddressId',
        ),
        'relationName' => 'emailEmailAddress',
        'conditions' => 
        array (
          'addressType' => 'bcc',
        ),
        'additionalColumns' => 
        array (
          'addressType' => 
          array (
            'type' => 'varchar',
            'len' => '4',
          ),
        ),
      ),
      'ccEmailAddresses' => 
      array (
        'type' => 'manyMany',
        'entity' => 'EmailAddress',
        'foreignKey' => 'id',
        'foreign' => NULL,
        'midKeys' => 
        array (
          0 => 'emailId',
          1 => 'emailAddressId',
        ),
        'relationName' => 'emailEmailAddress',
        'conditions' => 
        array (
          'addressType' => 'cc',
        ),
        'additionalColumns' => 
        array (
          'addressType' => 
          array (
            'type' => 'varchar',
            'len' => '4',
          ),
        ),
      ),
      'toEmailAddresses' => 
      array (
        'type' => 'manyMany',
        'entity' => 'EmailAddress',
        'foreignKey' => 'id',
        'foreign' => NULL,
        'midKeys' => 
        array (
          0 => 'emailId',
          1 => 'emailAddressId',
        ),
        'relationName' => 'emailEmailAddress',
        'conditions' => 
        array (
          'addressType' => 'to',
        ),
        'additionalColumns' => 
        array (
          'addressType' => 
          array (
            'type' => 'varchar',
            'len' => '4',
          ),
        ),
      ),
      'fromEmailAddress' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'EmailAddress',
        'key' => 'fromEmailAddressId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'replies' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Email',
        'foreignKey' => 'repliedId',
        'foreign' => 'replied',
      ),
      'replied' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Email',
        'key' => 'repliedId',
        'foreignKey' => 'id',
        'foreign' => 'replies',
      ),
      'parent' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'parentId',
      ),
      'sentBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'sentById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'users' => 
      array (
        'type' => 'manyMany',
        'entity' => 'User',
        'relationName' => 'emailUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'emailId',
          1 => 'userId',
        ),
        'foreign' => 'emails',
        'additionalColumns' => 
        array (
          'isRead' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
          'isImportant' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
          'inTrash' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
          'folderId' => 
          array (
            'type' => 'varchar',
            'default' => NULL,
            'maxLength' => 24,
          ),
        ),
      ),
      'assignedUsers' => 
      array (
        'type' => 'manyMany',
        'entity' => 'User',
        'relationName' => 'entityUser',
        'midKeys' => 
        array (
          0 => 'entityId',
          1 => 'userId',
        ),
        'conditions' => 
        array (
          'entityType' => 'Email',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Email',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'attachments' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Attachment',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
        'relationName' => 'attachments',
      ),
    ),
    'indexes' => 
    array (
      'dateSentAssignedUser' => 
      array (
        'columns' => 
        array (
          0 => 'dateSent',
          1 => 'assignedUserId',
        ),
      ),
      'dateSent' => 
      array (
        'columns' => 
        array (
          0 => 'dateSent',
          1 => 'deleted',
        ),
      ),
      'dateSentStatus' => 
      array (
        'columns' => 
        array (
          0 => 'dateSent',
          1 => 'status',
          2 => 'deleted',
        ),
      ),
    ),
  ),
  'EmailAccount' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'emailAddress' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'host' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'port' => 
      array (
        'type' => 'varchar',
        'default' => '143',
        'len' => 255,
      ),
      'ssl' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'username' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'password' => 
      array (
        'type' => 'password',
      ),
      'monitoredFolders' => 
      array (
        'type' => 'varchar',
        'default' => 'INBOX',
        'len' => 255,
      ),
      'sentFolder' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'storeSentEmails' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'keepFetchedEmailsUnread' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'fetchSince' => 
      array (
        'type' => 'date',
      ),
      'fetchData' => 
      array (
        'type' => 'jsonObject',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'useSmtp' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'smtpHost' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'smtpPort' => 
      array (
        'type' => 'int',
        'default' => '25',
        'len' => 11,
      ),
      'smtpAuth' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'smtpSecurity' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'smtpUsername' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'smtpPassword' => 
      array (
        'type' => 'password',
      ),
      'emailFolderId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'emailFolderName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'emailFolder',
        'foreign' => 'name',
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'emailsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'filtersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'filtersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'emailFolder' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'EmailFolder',
        'key' => 'emailFolderId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'emails' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Email',
        'relationName' => 'emailEmailAccount',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'emailAccountId',
          1 => 'emailId',
        ),
        'foreign' => 'emailAccounts',
      ),
      'filters' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'EmailFilter',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'EmailAddress' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'lower' => 
      array (
        'type' => 'varchar',
        'index' => true,
        'len' => 255,
      ),
      'invalid' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'optOut' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
    ),
    'relations' => 
    array (
    ),
  ),
  'EmailFilter' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'from' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'to' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'subject' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'bodyContains' => 
      array (
        'type' => 'jsonArray',
      ),
      'isGlobal' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'action' => 
      array (
        'type' => 'varchar',
        'default' => 'Skip',
        'len' => 255,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'parentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'parent',
        'notNull' => false,
      ),
      'parentType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'parent',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'parentName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailFolderId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'emailFolderName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'emailFolder',
        'foreign' => 'name',
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
    ),
    'relations' => 
    array (
      'emailFolder' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'EmailFolder',
        'key' => 'emailFolderId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'parent' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'parentId',
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'EmailFolder' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 64,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'order' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'skipNotifications' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
    ),
    'relations' => 
    array (
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'EmailTemplate' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'subject' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'body' => 
      array (
        'type' => 'text',
      ),
      'isHtml' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'oneOff' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'attachmentsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
    ),
    'relations' => 
    array (
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'EmailTemplate',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'attachments' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Attachment',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
    ),
  ),
  'Extension' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'version' => 
      array (
        'type' => 'varchar',
        'len' => 50,
      ),
      'fileList' => 
      array (
        'type' => 'jsonArray',
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'isInstalled' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
    ),
    'relations' => 
    array (
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'ExternalAccount' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 64,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'data' => 
      array (
        'type' => 'jsonObject',
      ),
      'enabled' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
    ),
    'relations' => 
    array (
    ),
  ),
  'Import' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'entityType' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'importedCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'duplicateCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'updatedCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'fileName' => 
      array (
        'type' => 'foreign',
        'relation' => 'file',
        'foreign' => 'name',
        'notStorable' => false,
      ),
      'fileId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
    ),
    'relations' => 
    array (
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'file' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Attachment',
        'key' => 'fileId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'InboundEmail' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'emailAddress' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'host' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'port' => 
      array (
        'type' => 'varchar',
        'default' => '143',
        'len' => 255,
      ),
      'ssl' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'username' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'password' => 
      array (
        'type' => 'password',
      ),
      'monitoredFolders' => 
      array (
        'type' => 'varchar',
        'default' => 'INBOX',
        'len' => 255,
      ),
      'fetchSince' => 
      array (
        'type' => 'date',
      ),
      'fetchData' => 
      array (
        'type' => 'jsonObject',
      ),
      'addAllTeamUsers' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'createCase' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'caseDistribution' => 
      array (
        'type' => 'varchar',
        'default' => 'Direct-Assignment',
        'len' => 255,
      ),
      'targetUserPosition' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'reply' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'replyFromAddress' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'replyToAddress' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'replyFromName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'assignToUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignToUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignToUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'teamName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'team',
        'foreign' => 'name',
      ),
      'replyEmailTemplateId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'replyEmailTemplateName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'replyEmailTemplate',
        'foreign' => 'name',
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'emailsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'filtersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'filtersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'emails' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Email',
        'relationName' => 'emailInboundEmail',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'inboundEmailId',
          1 => 'emailId',
        ),
        'foreign' => 'inboundEmails',
      ),
      'filters' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'EmailFilter',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'replyEmailTemplate' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'EmailTemplate',
        'key' => 'replyEmailTemplateId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'team' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Team',
        'key' => 'teamId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'assignToUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignToUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'Integration' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'data' => 
      array (
        'type' => 'jsonObject',
      ),
      'enabled' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
    ),
    'relations' => 
    array (
    ),
  ),
  'Job' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'default' => 'Pending',
        'len' => 255,
      ),
      'executeTime' => 
      array (
        'type' => 'datetime',
      ),
      'serviceName' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'method' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'data' => 
      array (
        'type' => 'jsonObject',
      ),
      'attempts' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'targetId' => 
      array (
        'type' => 'varchar',
        'len' => 48,
      ),
      'targetType' => 
      array (
        'type' => 'varchar',
        'len' => 64,
      ),
      'failedAttempts' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'scheduledJobId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'scheduledJobName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'scheduledJob',
        'foreign' => 'name',
      ),
    ),
    'relations' => 
    array (
      'scheduledJob' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'ScheduledJob',
        'key' => 'scheduledJobId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'executeTime' => 
      array (
        'columns' => 
        array (
          0 => 'status',
          1 => 'executeTime',
        ),
      ),
      'status' => 
      array (
        'columns' => 
        array (
          0 => 'status',
          1 => 'deleted',
        ),
      ),
    ),
  ),
  'NextNumber' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'entityType' => 
      array (
        'type' => 'varchar',
        'index' => true,
        'len' => 255,
      ),
      'fieldName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'value' => 
      array (
        'type' => 'int',
        'default' => '1',
        'len' => 11,
      ),
    ),
    'relations' => 
    array (
    ),
  ),
  'Note' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'post' => 
      array (
        'type' => 'text',
      ),
      'data' => 
      array (
        'type' => 'jsonObject',
      ),
      'type' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'targetType' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'number' => 
      array (
        'type' => 'int',
        'autoincrement' => true,
        'unique' => true,
        'index' => true,
        'len' => 11,
      ),
      'isGlobal' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'createdByGender' => 
      array (
        'type' => 'foreign',
        'relation' => 'createdBy',
        'foreign' => 'gender',
      ),
      'notifiedUserIdList' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'isInternal' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'parentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'parent',
        'notNull' => false,
      ),
      'parentType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'parent',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'parentName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'relatedId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'related',
        'notNull' => false,
      ),
      'relatedType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'related',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'relatedName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'superParentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'superParent',
        'notNull' => false,
      ),
      'superParentType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'superParent',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'superParentName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsTypes' => 
      array (
        'type' => 'jsonObject',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'users' => 
      array (
        'type' => 'manyMany',
        'entity' => 'User',
        'relationName' => 'noteUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'noteId',
          1 => 'userId',
        ),
        'foreign' => 'notes',
      ),
      'portals' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Portal',
        'relationName' => 'notePortal',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'noteId',
          1 => 'portalId',
        ),
        'foreign' => 'notes',
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'noteTeam',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'noteId',
          1 => 'teamId',
        ),
        'foreign' => 'notes',
      ),
      'related' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'relatedId',
      ),
      'superParent' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'superParentId',
      ),
      'parent' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'parentId',
      ),
      'attachments' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Attachment',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
        'relationName' => 'attachments',
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'createdAt' => 
      array (
        'type' => 'index',
        'columns' => 
        array (
          0 => 'createdAt',
        ),
      ),
      'parent' => 
      array (
        'type' => 'index',
        'columns' => 
        array (
          0 => 'parentId',
          1 => 'parentType',
        ),
      ),
      'parentAndSuperParent' => 
      array (
        'type' => 'index',
        'columns' => 
        array (
          0 => 'parentId',
          1 => 'parentType',
          2 => 'superParentId',
          3 => 'superParentType',
        ),
      ),
    ),
  ),
  'Notification' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'number' => 
      array (
        'type' => 'int',
        'autoincrement' => true,
        'unique' => true,
        'index' => true,
        'len' => 11,
      ),
      'data' => 
      array (
        'type' => 'jsonObject',
      ),
      'noteData' => 
      array (
        'type' => 'jsonObject',
        'notStorable' => true,
      ),
      'type' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'read' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'emailIsProcessed' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'message' => 
      array (
        'type' => 'text',
      ),
      'userId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'userName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'user',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'relatedId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'related',
        'notNull' => false,
      ),
      'relatedType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'related',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'relatedName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'relatedParentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'relatedParent',
        'notNull' => false,
      ),
      'relatedParentType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'relatedParent',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'relatedParentName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'relatedParent' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'relatedParentId',
      ),
      'related' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'relatedId',
      ),
      'user' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'userId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'createdAt' => 
      array (
        'type' => 'index',
        'columns' => 
        array (
          0 => 'createdAt',
        ),
      ),
      'user' => 
      array (
        'type' => 'index',
        'columns' => 
        array (
          0 => 'userId',
          1 => 'createdAt',
        ),
      ),
    ),
  ),
  'PasswordChangeRequest' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'requestId' => 
      array (
        'type' => 'varchar',
        'len' => 24,
        'index' => true,
      ),
      'url' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'userId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'userName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'user',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
    ),
    'relations' => 
    array (
      'user' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'userId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'PhoneNumber' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 36,
        'index' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'type' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
    ),
    'relations' => 
    array (
    ),
  ),
  'Portal' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'url' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'customId' => 
      array (
        'type' => 'varchar',
        'len' => 36,
        'index' => true,
      ),
      'isActive' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'isDefault' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => false,
      ),
      'tabList' => 
      array (
        'type' => 'jsonArray',
      ),
      'quickCreateList' => 
      array (
        'type' => 'jsonArray',
      ),
      'theme' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'language' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'timeZone' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'dateFormat' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'timeFormat' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'weekStart' => 
      array (
        'type' => 'int',
        'default' => '-1',
        'len' => 11,
      ),
      'defaultCurrency' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'dashboardLayout' => 
      array (
        'type' => 'jsonArray',
      ),
      'dashletsOptions' => 
      array (
        'type' => 'jsonObject',
      ),
      'customUrl' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'portalRolesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalRolesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'articlesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'articlesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'notesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'notesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'logoName' => 
      array (
        'type' => 'foreign',
        'relation' => 'logo',
        'foreign' => 'name',
        'notStorable' => false,
      ),
      'logoId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'companyLogoName' => 
      array (
        'type' => 'foreign',
        'relation' => 'companyLogo',
        'foreign' => 'name',
        'notStorable' => false,
      ),
      'companyLogoId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
    ),
    'relations' => 
    array (
      'articles' => 
      array (
        'type' => 'manyMany',
        'entity' => 'KnowledgeBaseArticle',
        'relationName' => 'knowledgeBaseArticlePortal',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'portalId',
          1 => 'knowledgeBaseArticleId',
        ),
        'foreign' => 'portals',
      ),
      'notes' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Note',
        'relationName' => 'notePortal',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'portalId',
          1 => 'noteId',
        ),
        'foreign' => 'portals',
      ),
      'portalRoles' => 
      array (
        'type' => 'manyMany',
        'entity' => 'PortalRole',
        'relationName' => 'portalPortalRole',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'portalId',
          1 => 'portalRoleId',
        ),
        'foreign' => 'portals',
      ),
      'users' => 
      array (
        'type' => 'manyMany',
        'entity' => 'User',
        'relationName' => 'portalUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'portalId',
          1 => 'userId',
        ),
        'foreign' => 'portals',
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'logo' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Attachment',
        'key' => 'logoId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'companyLogo' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Attachment',
        'key' => 'companyLogoId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'PortalRole' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 150,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'data' => 
      array (
        'type' => 'jsonObject',
      ),
      'fieldData' => 
      array (
        'type' => 'jsonObject',
      ),
      'portalsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'portals' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Portal',
        'relationName' => 'portalPortalRole',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'portalRoleId',
          1 => 'portalId',
        ),
        'foreign' => 'portalRoles',
      ),
      'users' => 
      array (
        'type' => 'manyMany',
        'entity' => 'User',
        'relationName' => 'portalRoleUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'portalRoleId',
          1 => 'userId',
        ),
        'foreign' => 'portalRoles',
      ),
    ),
  ),
  'Preferences' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'timeZone' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'dateFormat' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'timeFormat' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'weekStart' => 
      array (
        'type' => 'int',
        'default' => '-1',
        'len' => 11,
      ),
      'defaultCurrency' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'thousandSeparator' => 
      array (
        'type' => 'varchar',
        'len' => 1,
        'default' => ',',
      ),
      'decimalMark' => 
      array (
        'type' => 'varchar',
        'len' => 1,
        'default' => '.',
      ),
      'dashboardLayout' => 
      array (
        'type' => 'jsonArray',
      ),
      'dashletsOptions' => 
      array (
        'type' => 'jsonObject',
      ),
      'sharedCalendarUserList' => 
      array (
        'type' => 'jsonArray',
      ),
      'presetFilters' => 
      array (
        'type' => 'jsonObject',
      ),
      'smtpEmailAddress' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'smtpServer' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'smtpPort' => 
      array (
        'type' => 'int',
        'default' => '25',
        'len' => 11,
      ),
      'smtpAuth' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'smtpSecurity' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'smtpUsername' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'smtpPassword' => 
      array (
        'type' => 'password',
      ),
      'language' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'exportDelimiter' => 
      array (
        'type' => 'varchar',
        'len' => 1,
        'default' => ',',
      ),
      'receiveAssignmentEmailNotifications' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'receiveMentionEmailNotifications' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'receiveStreamEmailNotifications' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'autoFollowEntityTypeList' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'signature' => 
      array (
        'type' => 'text',
      ),
      'defaultReminders' => 
      array (
        'type' => 'jsonArray',
      ),
      'theme' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'useCustomTabList' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'tabList' => 
      array (
        'type' => 'jsonArray',
      ),
      'emailReplyToAllByDefault' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'emailReplyForceHtml' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'isPortalUser' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => false,
      ),
      'doNotFillAssignedUserIfNotRequired' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
    ),
    'relations' => 
    array (
    ),
  ),
  'Role' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 150,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'assignmentPermission' => 
      array (
        'type' => 'varchar',
        'default' => 'not-set',
        'len' => 255,
      ),
      'userPermission' => 
      array (
        'type' => 'varchar',
        'default' => 'not-set',
        'len' => 255,
      ),
      'portalPermission' => 
      array (
        'type' => 'varchar',
        'default' => 'not-set',
        'len' => 255,
      ),
      'data' => 
      array (
        'type' => 'jsonObject',
      ),
      'fieldData' => 
      array (
        'type' => 'jsonObject',
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'roleTeam',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'roleId',
          1 => 'teamId',
        ),
        'foreign' => 'roles',
      ),
      'users' => 
      array (
        'type' => 'manyMany',
        'entity' => 'User',
        'relationName' => 'roleUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'roleId',
          1 => 'userId',
        ),
        'foreign' => 'roles',
      ),
    ),
  ),
  'ScheduledJob' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'job' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'scheduling' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'lastRun' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'logIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'logNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'log' => 
      array (
        'type' => 'hasMany',
        'entity' => 'ScheduledJobLogRecord',
        'foreignKey' => 'scheduledJobId',
        'foreign' => 'scheduledJob',
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'ScheduledJobLogRecord' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'executionTime' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'scheduledJobId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'scheduledJobName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'scheduledJob',
        'foreign' => 'name',
      ),
      'targetId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'target',
        'notNull' => false,
      ),
      'targetType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'target',
        'dbType' => 'varchar',
        'len' => 255,
      ),
      'targetName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'scheduledJob' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'ScheduledJob',
        'key' => 'scheduledJobId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'Settings' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'useCache' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'recordsPerPage' => 
      array (
        'type' => 'int',
        'default' => '20',
        'len' => 11,
      ),
      'recordsPerPageSmall' => 
      array (
        'type' => 'int',
        'default' => '10',
        'len' => 11,
      ),
      'timeZone' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'dateFormat' => 
      array (
        'type' => 'varchar',
        'default' => 'MM/DD/YYYY',
        'len' => 255,
      ),
      'timeFormat' => 
      array (
        'type' => 'varchar',
        'default' => 'HH:mm',
        'len' => 255,
      ),
      'weekStart' => 
      array (
        'type' => 'int',
        'default' => '0',
        'len' => 11,
      ),
      'thousandSeparator' => 
      array (
        'type' => 'varchar',
        'len' => 1,
        'default' => ',',
      ),
      'decimalMark' => 
      array (
        'type' => 'varchar',
        'len' => 1,
        'default' => '.',
      ),
      'currencyList' => 
      array (
        'type' => 'jsonArray',
        'default' => '["USD","EUR"]',
      ),
      'defaultCurrency' => 
      array (
        'type' => 'varchar',
        'default' => 'USD',
        'len' => 255,
      ),
      'baseCurrency' => 
      array (
        'type' => 'varchar',
        'default' => 'USD',
        'len' => 255,
      ),
      'currencyRates' => 
      array (
        'type' => 'base',
        'notStorable' => true,
      ),
      'outboundEmailIsShared' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'outboundEmailFromName' => 
      array (
        'type' => 'varchar',
        'default' => 'EspoCRM',
        'len' => 255,
      ),
      'outboundEmailFromAddress' => 
      array (
        'type' => 'varchar',
        'default' => 'crm@example.com',
        'len' => 255,
      ),
      'smtpServer' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'smtpPort' => 
      array (
        'type' => 'int',
        'default' => '25',
        'len' => 11,
      ),
      'smtpAuth' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'smtpSecurity' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'smtpUsername' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'smtpPassword' => 
      array (
        'type' => 'password',
      ),
      'tabList' => 
      array (
        'type' => 'jsonArray',
      ),
      'quickCreateList' => 
      array (
        'type' => 'jsonArray',
      ),
      'language' => 
      array (
        'type' => 'varchar',
        'default' => 'en_US',
        'len' => 255,
      ),
      'globalSearchEntityList' => 
      array (
        'type' => 'jsonArray',
      ),
      'exportDelimiter' => 
      array (
        'type' => 'varchar',
        'len' => 1,
        'default' => ',',
      ),
      'authenticationMethod' => 
      array (
        'type' => 'varchar',
        'default' => 'Espo',
        'len' => 255,
      ),
      'ldapHost' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapPort' => 
      array (
        'type' => 'varchar',
        'default' => '389',
        'len' => 255,
      ),
      'ldapSecurity' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapAuth' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'ldapUsername' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapPassword' => 
      array (
        'type' => 'password',
      ),
      'ldapBindRequiresDn' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'ldapUserLoginFilter' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapBaseDn' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapAccountCanonicalForm' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapAccountDomainName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapAccountDomainNameShort' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapAccountFilterFormat' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapTryUsernameSplit' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'ldapOptReferrals' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'ldapCreateEspoUser' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'ldapUserNameAttribute' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapUserObjectClass' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapUserFirstNameAttribute' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapUserLastNameAttribute' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapUserTitleAttribute' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapUserEmailAddressAttribute' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'ldapUserPhoneNumberAttribute' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'exportDisabled' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'assignmentEmailNotifications' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'assignmentEmailNotificationsEntityList' => 
      array (
        'type' => 'jsonArray',
      ),
      'assignmentNotificationsEntityList' => 
      array (
        'type' => 'jsonArray',
      ),
      'postEmailNotifications' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'updateEmailNotifications' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'mentionEmailNotifications' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'streamEmailNotifications' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'portalStreamEmailNotifications' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'streamEmailNotificationsEntityList' => 
      array (
        'type' => 'jsonArray',
      ),
      'b2cMode' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'avatarsDisabled' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'followCreatedEntities' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'adminPanelIframeUrl' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'displayListViewRecordCount' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'userThemesDisabled' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'theme' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'emailMessageMaxSize' => 
      array (
        'type' => 'float',
        'notNull' => false,
      ),
      'inboundEmailMaxPortionSize' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'personalEmailMaxPortionSize' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'maxEmailAccountCount' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'massEmailMaxPerHourCount' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'authTokenLifetime' => 
      array (
        'type' => 'float',
        'notNull' => false,
        'default' => '0',
      ),
      'authTokenMaxIdleTime' => 
      array (
        'type' => 'float',
        'notNull' => false,
        'default' => '0',
      ),
      'dashboardLayout' => 
      array (
        'type' => 'jsonArray',
      ),
      'dashletsOptions' => 
      array (
        'type' => 'jsonObject',
      ),
      'siteUrl' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'applicationName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'readableDateFormatDisabled' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'addressFormat' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'notificationSoundsDisabled' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'calendarEntityList' => 
      array (
        'type' => 'jsonArray',
      ),
      'activitiesEntityList' => 
      array (
        'type' => 'jsonArray',
      ),
      'historyEntityList' => 
      array (
        'type' => 'jsonArray',
      ),
      'googleMapsApiKey' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'massEmailDisableMandatoryOptOutLink' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'addressPreviewStreet' => 
      array (
        'type' => 'text',
        'dbType' => 'varchar',
        'len' => 255,
        'notStorable' => true,
      ),
      'addressPreviewCity' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'addressPreviewState' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'addressPreviewCountry' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'addressPreviewPostalCode' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'addressPreviewMap' => 
      array (
        'type' => 'map',
        'notStorable' => true,
      ),
      'ldapUserDefaultTeamId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'ldapUserDefaultTeam',
        'notNull' => false,
      ),
      'ldapUserDefaultTeamName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'ldapUserTeamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'ldapUserTeamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'companyLogoName' => 
      array (
        'type' => 'foreign',
        'relation' => 'companyLogo',
        'foreign' => 'name',
        'notStorable' => false,
      ),
      'companyLogoId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
    ),
    'relations' => 
    array (
      'companyLogo' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Attachment',
        'key' => 'companyLogoId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'Team' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'positionList' => 
      array (
        'type' => 'jsonArray',
      ),
      'userRole' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'rolesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'rolesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'notesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'notesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'notes' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Note',
        'relationName' => 'noteTeam',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'teamId',
          1 => 'noteId',
        ),
        'foreign' => 'teams',
      ),
      'roles' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Role',
        'relationName' => 'roleTeam',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'teamId',
          1 => 'roleId',
        ),
        'foreign' => 'teams',
      ),
      'users' => 
      array (
        'type' => 'manyMany',
        'entity' => 'User',
        'relationName' => 'teamUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'teamId',
          1 => 'userId',
        ),
        'foreign' => 'teams',
        'additionalColumns' => 
        array (
          'role' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
    ),
  ),
  'Template' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'body' => 
      array (
        'type' => 'text',
      ),
      'header' => 
      array (
        'type' => 'text',
      ),
      'footer' => 
      array (
        'type' => 'text',
      ),
      'entityType' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'leftMargin' => 
      array (
        'type' => 'float',
        'notNull' => false,
        'default' => '10',
      ),
      'rightMargin' => 
      array (
        'type' => 'float',
        'notNull' => false,
        'default' => '10',
      ),
      'topMargin' => 
      array (
        'type' => 'float',
        'notNull' => false,
        'default' => '10',
      ),
      'bottomMargin' => 
      array (
        'type' => 'float',
        'notNull' => false,
        'default' => '25',
      ),
      'printFooter' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'footerPosition' => 
      array (
        'type' => 'float',
        'notNull' => false,
        'default' => '15',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
    ),
    'relations' => 
    array (
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Template',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
    ),
  ),
  'UniqueId' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'index' => true,
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'data' => 
      array (
        'type' => 'jsonObject',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
    ),
    'relations' => 
    array (
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'User' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'select' => 'TRIM(CONCAT(IFNULL(user.first_name, \'\'), \' \', IFNULL(user.last_name, \'\')))',
        'where' => 
        array (
          'LIKE' => '(user.first_name LIKE {value} OR user.last_name LIKE {value} OR CONCAT(user.first_name, \' \', user.last_name) LIKE {value} OR CONCAT(user.last_name, \' \', user.first_name) LIKE {value})',
          '=' => '(user.first_name = {value} OR user.last_name = {value} OR CONCAT(user.first_name, \' \', user.last_name) = {value} OR CONCAT(user.last_name, \' \', user.first_name) = {value})',
        ),
        'orderBy' => 'user.first_name {direction}',
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'isAdmin' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'userName' => 
      array (
        'type' => 'varchar',
        'len' => 50,
      ),
      'password' => 
      array (
        'type' => 'password',
        'len' => 150,
      ),
      'passwordConfirm' => 
      array (
        'type' => 'password',
        'len' => 150,
        'notStorable' => true,
      ),
      'salutationName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'firstName' => 
      array (
        'type' => 'varchar',
        'len' => 100,
        'default' => '',
      ),
      'lastName' => 
      array (
        'type' => 'varchar',
        'len' => 100,
        'default' => '',
      ),
      'isActive' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => true,
      ),
      'isPortalUser' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'isSuperAdmin' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'title' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'position' => 
      array (
        'type' => 'varchar',
        'len' => 100,
        'notStorable' => true,
        'where' => 
        array (
          'LIKE' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'teams',
                1 => 'teamsPosition',
              ),
            ),
            'sql' => 'teamsPositionMiddle.role LIKE {value}',
            'distinct' => true,
          ),
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'teams',
                1 => 'teamsPosition',
              ),
            ),
            'sql' => 'teamsPositionMiddle.role = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'teams',
                1 => 'teamsPosition',
              ),
            ),
            'sql' => 'teamsPositionMiddle.role <> {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'teams',
                1 => 'teamsPosition',
              ),
            ),
            'sql' => 'teamsPositionMiddle.role IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'teams',
                1 => 'teamsPosition',
              ),
            ),
            'sql' => 'teamsPositionMiddle.role IS NOT NULL',
            'distinct' => true,
          ),
        ),
      ),
      'emailAddress' => 
      array (
        'type' => 'email',
        'notStorable' => true,
        'select' => 'emailAddresses.name',
        'where' => 
        array (
          'LIKE' => 'user.id IN (
                                SELECT entity_id
                                FROM entity_email_address
                                JOIN email_address ON email_address.id = entity_email_address.email_address_id
                                WHERE
                                    entity_email_address.deleted = 0 AND entity_email_address.entity_type = \'User\' AND
                                    email_address.deleted = 0 AND email_address.name LIKE {value}
                            )',
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name <> {value}',
            'distinct' => true,
          ),
          'IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IN {value}',
            'distinct' => true,
          ),
          'NOT IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name NOT IN {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IS NOT NULL',
            'distinct' => true,
          ),
        ),
        'orderBy' => 'emailAddresses.name {direction}',
      ),
      'phoneNumber' => 
      array (
        'type' => 'phone',
        'notStorable' => true,
        'select' => 'phoneNumbers.name',
        'where' => 
        array (
          'LIKE' => 'user.id IN (
                                SELECT entity_id
                                FROM entity_phone_number
                                JOIN phone_number ON phone_number.id = entity_phone_number.phone_number_id
                                WHERE
                                    entity_phone_number.deleted = 0 AND entity_phone_number.entity_type = \'User\' AND
                                    phone_number.deleted = 0 AND phone_number.name LIKE {value}
                            )',
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name <> {value}',
            'distinct' => true,
          ),
          'IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IN {value}',
            'distinct' => true,
          ),
          'NOT IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name NOT IN {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IS NOT NULL',
            'distinct' => true,
          ),
        ),
        'orderBy' => 'phoneNumbers.name {direction}',
      ),
      'token' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'acceptanceStatus' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'teamRole' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'sendAccessInfo' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => false,
      ),
      'gender' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'emailAddressData' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'phoneNumberData' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'defaultTeamId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'defaultTeamName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'defaultTeam',
        'foreign' => 'name',
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsColumns' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'rolesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'rolesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalRolesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalRolesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'contactName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'contact',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'accountsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'account',
        'notStorable' => true,
        'notNull' => false,
      ),
      'accountName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'portal',
        'notStorable' => true,
        'notNull' => false,
      ),
      'portalName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'notesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'notesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'preferencesId' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'preferencesName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'avatarName' => 
      array (
        'type' => 'foreign',
        'relation' => 'avatar',
        'foreign' => 'name',
        'notStorable' => false,
      ),
      'avatarId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
    ),
    'relations' => 
    array (
      'emailAddresses' => 
      array (
        'type' => 'manyMany',
        'entity' => 'EmailAddress',
        'relationName' => 'entityEmailAddress',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'email_address_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'User',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
          'primary' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
        ),
      ),
      'phoneNumbers' => 
      array (
        'type' => 'manyMany',
        'entity' => 'PhoneNumber',
        'relationName' => 'entityPhoneNumber',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'phone_number_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'User',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
          'primary' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
        ),
      ),
      'targetLists' => 
      array (
        'type' => 'manyMany',
        'entity' => 'TargetList',
        'relationName' => 'targetListUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'userId',
          1 => 'targetListId',
        ),
        'foreign' => 'users',
        'additionalColumns' => 
        array (
          'optedOut' => 
          array (
            'type' => 'bool',
          ),
        ),
      ),
      'tasks' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Task',
        'foreignKey' => 'assignedUserId',
        'foreign' => 'assignedUser',
      ),
      'accounts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Account',
        'relationName' => 'AccountPortalUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'userId',
          1 => 'accountId',
        ),
        'foreign' => 'portalUsers',
      ),
      'contact' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Contact',
        'key' => 'contactId',
        'foreignKey' => 'id',
        'foreign' => 'portalUser',
      ),
      'notes' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Note',
        'relationName' => 'noteUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'userId',
          1 => 'noteId',
        ),
        'foreign' => 'users',
      ),
      'emails' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Email',
        'relationName' => 'emailUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'userId',
          1 => 'emailId',
        ),
        'foreign' => 'users',
        'additionalColumns' => 
        array (
          'isRead' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
          'isImportant' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
          'inTrash' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
          'folderId' => 
          array (
            'type' => 'varchar',
            'default' => NULL,
            'maxLength' => 24,
          ),
        ),
      ),
      'calls' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Call',
        'relationName' => 'callUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'userId',
          1 => 'callId',
        ),
        'foreign' => 'users',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'meetings' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Meeting',
        'relationName' => 'meetingUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'userId',
          1 => 'meetingId',
        ),
        'foreign' => 'users',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'preferences' => 
      array (
        'type' => 'hasOne',
        'entity' => 'Preferences',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'portalRoles' => 
      array (
        'type' => 'manyMany',
        'entity' => 'PortalRole',
        'relationName' => 'portalRoleUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'userId',
          1 => 'portalRoleId',
        ),
        'foreign' => 'users',
      ),
      'portals' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Portal',
        'relationName' => 'portalUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'userId',
          1 => 'portalId',
        ),
        'foreign' => 'users',
      ),
      'roles' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Role',
        'relationName' => 'roleUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'userId',
          1 => 'roleId',
        ),
        'foreign' => 'users',
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'teamUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'userId',
          1 => 'teamId',
        ),
        'foreign' => 'users',
        'additionalColumns' => 
        array (
          'role' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'defaultTeam' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Team',
        'key' => 'defaultTeamId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'avatar' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Attachment',
        'key' => 'avatarId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'Account' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'website' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'emailAddress' => 
      array (
        'type' => 'email',
        'notStorable' => true,
        'select' => 'emailAddresses.name',
        'where' => 
        array (
          'LIKE' => 'account.id IN (
                                SELECT entity_id
                                FROM entity_email_address
                                JOIN email_address ON email_address.id = entity_email_address.email_address_id
                                WHERE
                                    entity_email_address.deleted = 0 AND entity_email_address.entity_type = \'Account\' AND
                                    email_address.deleted = 0 AND email_address.name LIKE {value}
                            )',
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name <> {value}',
            'distinct' => true,
          ),
          'IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IN {value}',
            'distinct' => true,
          ),
          'NOT IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name NOT IN {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IS NOT NULL',
            'distinct' => true,
          ),
        ),
        'orderBy' => 'emailAddresses.name {direction}',
      ),
      'phoneNumber' => 
      array (
        'type' => 'phone',
        'notStorable' => true,
        'select' => 'phoneNumbers.name',
        'where' => 
        array (
          'LIKE' => 'account.id IN (
                                SELECT entity_id
                                FROM entity_phone_number
                                JOIN phone_number ON phone_number.id = entity_phone_number.phone_number_id
                                WHERE
                                    entity_phone_number.deleted = 0 AND entity_phone_number.entity_type = \'Account\' AND
                                    phone_number.deleted = 0 AND phone_number.name LIKE {value}
                            )',
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name <> {value}',
            'distinct' => true,
          ),
          'IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IN {value}',
            'distinct' => true,
          ),
          'NOT IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name NOT IN {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IS NOT NULL',
            'distinct' => true,
          ),
        ),
        'orderBy' => 'phoneNumbers.name {direction}',
      ),
      'type' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'industry' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'sicCode' => 
      array (
        'type' => 'varchar',
        'len' => 40,
      ),
      'contactRole' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'billingAddressStreet' => 
      array (
        'type' => 'text',
        'dbType' => 'varchar',
        'len' => 255,
      ),
      'billingAddressCity' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'billingAddressState' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'billingAddressCountry' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'billingAddressPostalCode' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'shippingAddressStreet' => 
      array (
        'type' => 'text',
        'dbType' => 'varchar',
        'len' => 255,
      ),
      'shippingAddressCity' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'shippingAddressState' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'shippingAddressCountry' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'shippingAddressPostalCode' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'billingAddressMap' => 
      array (
        'type' => 'map',
        'notStorable' => true,
      ),
      'shippingAddressMap' => 
      array (
        'type' => 'map',
        'notStorable' => true,
      ),
      'emailAddressData' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'phoneNumberData' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'campaignId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'campaignName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'relation' => 'campaign',
        'foreign' => 'name',
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'targetList',
        'notStorable' => true,
        'notNull' => false,
      ),
      'targetListName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'originalLeadId' => 
      array (
        'type' => 'varchar',
        'index' => 'originalLead',
        'notStorable' => true,
      ),
      'originalLeadName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'isFollowed' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'followersIds' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'followersNames' => 
      array (
        'type' => 'jsonObject',
        'notStorable' => true,
      ),
      'portalUsersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalUsersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignLogRecordsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignLogRecordsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksPrimaryIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksPrimaryNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsPrimaryIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsPrimaryNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsPrimaryIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsPrimaryNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsPrimaryIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsPrimaryNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'documentsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'documentsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'casesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'casesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'opportunitiesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'opportunitiesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'emailAddresses' => 
      array (
        'type' => 'manyMany',
        'entity' => 'EmailAddress',
        'relationName' => 'entityEmailAddress',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'email_address_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Account',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
          'primary' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
        ),
      ),
      'phoneNumbers' => 
      array (
        'type' => 'manyMany',
        'entity' => 'PhoneNumber',
        'relationName' => 'entityPhoneNumber',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'phone_number_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Account',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
          'primary' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
        ),
      ),
      'originalLead' => 
      array (
        'type' => 'hasOne',
        'entity' => 'Lead',
        'foreignKey' => 'createdAccountId',
        'foreign' => 'createdAccount',
        'noJoin' => true,
      ),
      'portalUsers' => 
      array (
        'type' => 'manyMany',
        'entity' => 'User',
        'relationName' => 'AccountPortalUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'accountId',
          1 => 'userId',
        ),
        'foreign' => 'accounts',
      ),
      'targetLists' => 
      array (
        'type' => 'manyMany',
        'entity' => 'TargetList',
        'relationName' => 'accountTargetList',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'accountId',
          1 => 'targetListId',
        ),
        'foreign' => 'accounts',
        'additionalColumns' => 
        array (
          'optedOut' => 
          array (
            'type' => 'bool',
          ),
        ),
      ),
      'campaignLogRecords' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'CampaignLogRecord',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'campaign' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Campaign',
        'key' => 'campaignId',
        'foreignKey' => 'id',
        'foreign' => 'accounts',
        'noJoin' => true,
      ),
      'emails' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Email',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'tasks' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Task',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'calls' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Call',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'meetings' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Meeting',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'tasksPrimary' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Task',
        'foreignKey' => 'accountId',
        'foreign' => 'account',
      ),
      'callsPrimary' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Call',
        'foreignKey' => 'accountId',
        'foreign' => 'account',
      ),
      'emailsPrimary' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Email',
        'foreignKey' => 'accountId',
        'foreign' => 'account',
      ),
      'meetingsPrimary' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Meeting',
        'foreignKey' => 'accountId',
        'foreign' => 'account',
      ),
      'documents' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Document',
        'relationName' => 'accountDocument',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'accountId',
          1 => 'documentId',
        ),
        'foreign' => 'accounts',
      ),
      'cases' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Case',
        'foreignKey' => 'accountId',
        'foreign' => 'account',
      ),
      'opportunities' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Opportunity',
        'foreignKey' => 'accountId',
        'foreign' => 'account',
      ),
      'contacts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Contact',
        'relationName' => 'accountContact',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'accountId',
          1 => 'contactId',
        ),
        'foreign' => 'accounts',
        'additionalColumns' => 
        array (
          'role' => 
          array (
            'type' => 'varchar',
            'len' => 50,
          ),
        ),
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Account',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'name' => 
      array (
        'columns' => 
        array (
          0 => 'name',
          1 => 'deleted',
        ),
      ),
      'assignedUser' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'deleted',
        ),
      ),
    ),
  ),
  'Call' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'default' => 'Planned',
        'len' => 255,
      ),
      'dateStart' => 
      array (
        'type' => 'datetime',
      ),
      'dateEnd' => 
      array (
        'type' => 'datetime',
      ),
      'duration' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'default' => '300',
        'select' => 'TIMESTAMPDIFF(SECOND, date_start, date_end)',
        'orderBy' => 'duration {direction}',
        'len' => 11,
      ),
      'reminders' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'direction' => 
      array (
        'type' => 'varchar',
        'default' => 'Outbound',
        'len' => 255,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'acceptanceStatus' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'parentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'parent',
        'notNull' => false,
      ),
      'parentType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'parent',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'parentName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'accountName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'account',
        'foreign' => 'name',
      ),
      'usersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersColumns' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsColumns' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsColumns' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'parent' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'parentId',
      ),
      'leads' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Lead',
        'relationName' => 'callLead',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'callId',
          1 => 'leadId',
        ),
        'foreign' => 'calls',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'contacts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Contact',
        'relationName' => 'callContact',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'callId',
          1 => 'contactId',
        ),
        'foreign' => 'calls',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'users' => 
      array (
        'type' => 'manyMany',
        'entity' => 'User',
        'relationName' => 'callUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'callId',
          1 => 'userId',
        ),
        'foreign' => 'calls',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Call',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'account' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Account',
        'key' => 'accountId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'dateStartStatus' => 
      array (
        'columns' => 
        array (
          0 => 'dateStart',
          1 => 'status',
        ),
      ),
      'dateStart' => 
      array (
        'columns' => 
        array (
          0 => 'dateStart',
          1 => 'deleted',
        ),
      ),
      'status' => 
      array (
        'columns' => 
        array (
          0 => 'status',
          1 => 'deleted',
        ),
      ),
      'assignedUser' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'deleted',
        ),
      ),
      'assignedUserStatus' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'status',
        ),
      ),
    ),
  ),
  'Campaign' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'default' => 'Planning',
        'len' => 255,
      ),
      'type' => 
      array (
        'type' => 'varchar',
        'default' => 'Email',
        'len' => 255,
      ),
      'startDate' => 
      array (
        'type' => 'date',
        'notNull' => false,
      ),
      'endDate' => 
      array (
        'type' => 'date',
        'notNull' => false,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'sentCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'openedCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'clickedCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'optedOutCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'bouncedCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'hardBouncedCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'softBouncedCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'leadCreatedCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'openedPercentage' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'clickedPercentage' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'optedOutPercentage' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'bouncedPercentage' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'revenue' => 
      array (
        'type' => 'float',
        'notStorable' => true,
        'orderBy' => 'revenueConverted {direction}',
      ),
      'budget' => 
      array (
        'type' => 'float',
        'orderBy' => 'budgetConverted {direction}',
      ),
      'revenueCurrency' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'budgetCurrency' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'excludingTargetListsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'excludingTargetListsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'budgetConverted' => 
      array (
        'type' => 'float',
        'select' => 'campaign.budget * budget_currency_alias.rate',
        'where' => 
        array (
          '=' => 'campaign.budget * budget_currency_alias.rate = {value}',
          '>' => 'campaign.budget * budget_currency_alias.rate > {value}',
          '<' => 'campaign.budget * budget_currency_alias.rate < {value}',
          '>=' => 'campaign.budget * budget_currency_alias.rate >= {value}',
          '<=' => 'campaign.budget * budget_currency_alias.rate <= {value}',
          '<>' => 'campaign.budget * budget_currency_alias.rate <> {value}',
          'IS NULL' => 'campaign.budget IS NULL',
          'IS NOT NULL' => 'campaign.budget IS NOT NULL',
        ),
        'notStorable' => true,
        'orderBy' => 'budgetConverted {direction}',
      ),
      'massEmailsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'massEmailsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'trackingUrlsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'trackingUrlsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignLogRecordsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignLogRecordsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'opportunitiesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'opportunitiesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'massEmails' => 
      array (
        'type' => 'hasMany',
        'entity' => 'MassEmail',
        'foreignKey' => 'campaignId',
        'foreign' => 'campaign',
      ),
      'trackingUrls' => 
      array (
        'type' => 'hasMany',
        'entity' => 'CampaignTrackingUrl',
        'foreignKey' => 'campaignId',
        'foreign' => 'campaign',
      ),
      'campaignLogRecords' => 
      array (
        'type' => 'hasMany',
        'entity' => 'CampaignLogRecord',
        'foreignKey' => 'campaignId',
        'foreign' => 'campaign',
      ),
      'opportunities' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Opportunity',
        'foreignKey' => 'campaignId',
        'foreign' => 'campaign',
        'noJoin' => true,
      ),
      'leads' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Lead',
        'foreignKey' => 'campaignId',
        'foreign' => 'campaign',
        'noJoin' => true,
      ),
      'contacts' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Contact',
        'foreignKey' => 'campaignId',
        'foreign' => 'campaign',
        'noJoin' => true,
      ),
      'accounts' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Account',
        'foreignKey' => 'campaignId',
        'foreign' => 'campaign',
        'noJoin' => true,
      ),
      'excludingTargetLists' => 
      array (
        'type' => 'manyMany',
        'entity' => 'TargetList',
        'relationName' => 'campaignTargetListExcluding',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'campaignId',
          1 => 'targetListId',
        ),
        'foreign' => 'campaignsExcluding',
      ),
      'targetLists' => 
      array (
        'type' => 'manyMany',
        'entity' => 'TargetList',
        'relationName' => 'campaignTargetList',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'campaignId',
          1 => 'targetListId',
        ),
        'foreign' => 'campaigns',
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Campaign',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'createdAt' => 
      array (
        'columns' => 
        array (
          0 => 'createdAt',
          1 => 'deleted',
        ),
      ),
    ),
  ),
  'CampaignLogRecord' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'action' => 
      array (
        'type' => 'varchar',
        'len' => 50,
      ),
      'actionDate' => 
      array (
        'type' => 'datetime',
      ),
      'data' => 
      array (
        'type' => 'jsonObject',
      ),
      'stringData' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'stringAdditionalData' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'application' => 
      array (
        'type' => 'varchar',
        'len' => 36,
        'default' => 'Espo',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'isTest' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'campaignId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'campaignName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'campaign',
        'foreign' => 'name',
      ),
      'parentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'parent',
        'notNull' => false,
      ),
      'parentType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'parent',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'parentName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'objectId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'object',
        'notNull' => false,
      ),
      'objectType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'object',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'objectName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'queueItemId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'queueItemName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'relation' => 'queueItem',
        'foreign' => 'name',
      ),
    ),
    'relations' => 
    array (
      'object' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'objectId',
      ),
      'parent' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'parentId',
      ),
      'queueItem' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'EmailQueueItem',
        'key' => 'queueItemId',
        'foreignKey' => 'id',
        'foreign' => NULL,
        'noJoin' => true,
      ),
      'campaign' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Campaign',
        'key' => 'campaignId',
        'foreignKey' => 'id',
        'foreign' => 'campaignLogRecords',
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'actionDate' => 
      array (
        'columns' => 
        array (
          0 => 'actionDate',
          1 => 'deleted',
        ),
      ),
      'action' => 
      array (
        'columns' => 
        array (
          0 => 'action',
          1 => 'deleted',
        ),
      ),
    ),
  ),
  'CampaignTrackingUrl' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'url' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'urlToUse' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'campaignId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'campaignName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'campaign',
        'foreign' => 'name',
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
    ),
    'relations' => 
    array (
      'campaign' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Campaign',
        'key' => 'campaignId',
        'foreignKey' => 'id',
        'foreign' => 'trackingUrls',
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'Case' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'number' => 
      array (
        'type' => 'int',
        'autoincrement' => true,
        'unique' => true,
        'index' => true,
        'len' => 11,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'default' => 'New',
        'len' => 255,
      ),
      'priority' => 
      array (
        'type' => 'varchar',
        'default' => 'Normal',
        'len' => 255,
      ),
      'type' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'accountId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'accountName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'account',
        'foreign' => 'name',
      ),
      'leadId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'leadName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'lead',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'contactId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'contactName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'contact',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'contactsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'inboundEmailId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'inboundEmailName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'inboundEmail',
        'foreign' => 'name',
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'isFollowed' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'followersIds' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'followersNames' => 
      array (
        'type' => 'jsonObject',
        'notStorable' => true,
      ),
      'articlesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'articlesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'articles' => 
      array (
        'type' => 'manyMany',
        'entity' => 'KnowledgeBaseArticle',
        'relationName' => 'caseKnowledgeBaseArticle',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'caseId',
          1 => 'knowledgeBaseArticleId',
        ),
        'foreign' => 'cases',
      ),
      'emails' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Email',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'tasks' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Task',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'calls' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Call',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'meetings' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Meeting',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'contacts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Contact',
        'relationName' => 'caseContact',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'caseId',
          1 => 'contactId',
        ),
        'foreign' => 'cases',
      ),
      'contact' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Contact',
        'key' => 'contactId',
        'foreignKey' => 'id',
        'foreign' => 'casesPrimary',
      ),
      'lead' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Lead',
        'key' => 'leadId',
        'foreignKey' => 'id',
        'foreign' => 'cases',
      ),
      'account' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Account',
        'key' => 'accountId',
        'foreignKey' => 'id',
        'foreign' => 'cases',
      ),
      'inboundEmail' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'InboundEmail',
        'key' => 'inboundEmailId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Case',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'status' => 
      array (
        'columns' => 
        array (
          0 => 'status',
          1 => 'deleted',
        ),
      ),
      'assignedUser' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'deleted',
        ),
      ),
      'assignedUserStatus' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'status',
        ),
      ),
    ),
  ),
  'Contact' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'select' => 'TRIM(CONCAT(IFNULL(contact.first_name, \'\'), \' \', IFNULL(contact.last_name, \'\')))',
        'where' => 
        array (
          'LIKE' => '(contact.first_name LIKE {value} OR contact.last_name LIKE {value} OR CONCAT(contact.first_name, \' \', contact.last_name) LIKE {value} OR CONCAT(contact.last_name, \' \', contact.first_name) LIKE {value})',
          '=' => '(contact.first_name = {value} OR contact.last_name = {value} OR CONCAT(contact.first_name, \' \', contact.last_name) = {value} OR CONCAT(contact.last_name, \' \', contact.first_name) = {value})',
        ),
        'orderBy' => 'contact.first_name {direction}',
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'salutationName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'firstName' => 
      array (
        'type' => 'varchar',
        'len' => 100,
        'default' => '',
      ),
      'lastName' => 
      array (
        'type' => 'varchar',
        'len' => 100,
        'default' => '',
      ),
      'accountId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'where' => 
        array (
          '=' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND account_id = {value})',
          '<>' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND account_id <> {value})',
          'IN' => 'contact.id IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND account_id IN {value})',
          'NOT IN' => 'contact.id NOT IN (SELECT contact_id FROM account_contact WHERE deleted = 0 AND account_id IN {value})',
          'IS NULL' => 'contact.account_id IS NULL',
          'IS NOT NULL' => 'contact.account_id IS NOT NULL',
        ),
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'title' => 
      array (
        'type' => 'varchar',
        'len' => 50,
        'notStorable' => true,
        'select' => 'accountContact.role',
        'orderBy' => 'accountContact.role {direction}',
        'where' => 
        array (
          'LIKE' => 
          array (
            'leftJoins' => 
            array (
              0 => 'accounts',
            ),
            'sql' => 'accountsMiddle.role LIKE {value}',
            'distinct' => true,
          ),
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 'accounts',
            ),
            'sql' => 'accountsMiddle.role = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 'accounts',
            ),
            'sql' => 'accountsMiddle.role <> {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 'accounts',
            ),
            'sql' => 'accountsMiddle.role IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 'accounts',
            ),
            'sql' => 'accountsMiddle.role IS NOT NULL',
            'distinct' => true,
          ),
        ),
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'emailAddress' => 
      array (
        'type' => 'email',
        'notStorable' => true,
        'select' => 'emailAddresses.name',
        'where' => 
        array (
          'LIKE' => 'contact.id IN (
                                SELECT entity_id
                                FROM entity_email_address
                                JOIN email_address ON email_address.id = entity_email_address.email_address_id
                                WHERE
                                    entity_email_address.deleted = 0 AND entity_email_address.entity_type = \'Contact\' AND
                                    email_address.deleted = 0 AND email_address.name LIKE {value}
                            )',
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name <> {value}',
            'distinct' => true,
          ),
          'IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IN {value}',
            'distinct' => true,
          ),
          'NOT IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name NOT IN {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IS NOT NULL',
            'distinct' => true,
          ),
        ),
        'orderBy' => 'emailAddresses.name {direction}',
      ),
      'phoneNumber' => 
      array (
        'type' => 'phone',
        'notStorable' => true,
        'select' => 'phoneNumbers.name',
        'where' => 
        array (
          'LIKE' => 'contact.id IN (
                                SELECT entity_id
                                FROM entity_phone_number
                                JOIN phone_number ON phone_number.id = entity_phone_number.phone_number_id
                                WHERE
                                    entity_phone_number.deleted = 0 AND entity_phone_number.entity_type = \'Contact\' AND
                                    phone_number.deleted = 0 AND phone_number.name LIKE {value}
                            )',
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name <> {value}',
            'distinct' => true,
          ),
          'IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IN {value}',
            'distinct' => true,
          ),
          'NOT IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name NOT IN {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IS NOT NULL',
            'distinct' => true,
          ),
        ),
        'orderBy' => 'phoneNumbers.name {direction}',
      ),
      'doNotCall' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'addressStreet' => 
      array (
        'type' => 'text',
        'dbType' => 'varchar',
        'len' => 255,
      ),
      'addressCity' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressState' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressCountry' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressPostalCode' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'accountRole' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'accountType' => 
      array (
        'type' => 'foreign',
        'relation' => 'account',
        'foreign' => 'type',
      ),
      'opportunityRole' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'acceptanceStatus' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'addressMap' => 
      array (
        'type' => 'map',
        'notStorable' => true,
      ),
      'emailAddressData' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'phoneNumberData' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'accountName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'account',
        'foreign' => 'name',
      ),
      'accountsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountsColumns' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'campaignName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'relation' => 'campaign',
        'foreign' => 'name',
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'targetList',
        'notStorable' => true,
        'notNull' => false,
      ),
      'targetListName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalUserId' => 
      array (
        'type' => 'varchar',
        'index' => 'portalUser',
        'notStorable' => true,
      ),
      'portalUserName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'originalLeadId' => 
      array (
        'type' => 'varchar',
        'index' => 'originalLead',
        'notStorable' => true,
      ),
      'originalLeadName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'isFollowed' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'followersIds' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'followersNames' => 
      array (
        'type' => 'jsonObject',
        'notStorable' => true,
      ),
      'documentsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'documentsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignLogRecordsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignLogRecordsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'casesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'casesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'casesPrimaryIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'casesPrimaryNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'opportunitiesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'opportunitiesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'emailAddresses' => 
      array (
        'type' => 'manyMany',
        'entity' => 'EmailAddress',
        'relationName' => 'entityEmailAddress',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'email_address_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Contact',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
          'primary' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
        ),
      ),
      'phoneNumbers' => 
      array (
        'type' => 'manyMany',
        'entity' => 'PhoneNumber',
        'relationName' => 'entityPhoneNumber',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'phone_number_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Contact',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
          'primary' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
        ),
      ),
      'documents' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Document',
        'relationName' => 'contactDocument',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'contactId',
          1 => 'documentId',
        ),
        'foreign' => 'contacts',
      ),
      'originalLead' => 
      array (
        'type' => 'hasOne',
        'entity' => 'Lead',
        'foreignKey' => 'createdContactId',
        'foreign' => 'createdContact',
        'noJoin' => true,
      ),
      'portalUser' => 
      array (
        'type' => 'hasOne',
        'entity' => 'User',
        'foreignKey' => 'contactId',
        'foreign' => 'contact',
      ),
      'targetLists' => 
      array (
        'type' => 'manyMany',
        'entity' => 'TargetList',
        'relationName' => 'contactTargetList',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'contactId',
          1 => 'targetListId',
        ),
        'foreign' => 'contacts',
        'additionalColumns' => 
        array (
          'optedOut' => 
          array (
            'type' => 'bool',
          ),
        ),
      ),
      'campaignLogRecords' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'CampaignLogRecord',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'campaign' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Campaign',
        'key' => 'campaignId',
        'foreignKey' => 'id',
        'foreign' => 'contacts',
        'noJoin' => true,
      ),
      'emails' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Email',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'tasks' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Task',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'calls' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Call',
        'relationName' => 'callContact',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'contactId',
          1 => 'callId',
        ),
        'foreign' => 'contacts',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'meetings' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Meeting',
        'relationName' => 'contactMeeting',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'contactId',
          1 => 'meetingId',
        ),
        'foreign' => 'contacts',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'cases' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Case',
        'relationName' => 'caseContact',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'contactId',
          1 => 'caseId',
        ),
        'foreign' => 'contacts',
      ),
      'casesPrimary' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Case',
        'foreignKey' => 'contactId',
        'foreign' => 'contact',
      ),
      'opportunities' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Opportunity',
        'relationName' => 'contactOpportunity',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'contactId',
          1 => 'opportunityId',
        ),
        'foreign' => 'contacts',
        'additionalColumns' => 
        array (
          'role' => 
          array (
            'type' => 'varchar',
            'len' => 50,
          ),
        ),
      ),
      'accounts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Account',
        'relationName' => 'accountContact',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'contactId',
          1 => 'accountId',
        ),
        'foreign' => 'contacts',
        'additionalColumns' => 
        array (
          'role' => 
          array (
            'type' => 'varchar',
            'len' => 50,
          ),
        ),
      ),
      'account' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Account',
        'key' => 'accountId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Contact',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'firstName' => 
      array (
        'columns' => 
        array (
          0 => 'firstName',
          1 => 'deleted',
        ),
      ),
      'name' => 
      array (
        'columns' => 
        array (
          0 => 'firstName',
          1 => 'lastName',
        ),
      ),
      'assignedUser' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'deleted',
        ),
      ),
    ),
  ),
  'Document' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'source' => 
      array (
        'type' => 'varchar',
        'default' => 'Espo',
        'len' => 255,
      ),
      'type' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'publishDate' => 
      array (
        'type' => 'date',
      ),
      'expirationDate' => 
      array (
        'type' => 'date',
        'notNull' => false,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'folderId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'folderName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'folder',
        'foreign' => 'name',
      ),
      'contactsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'opportunitiesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'opportunitiesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'fileName' => 
      array (
        'type' => 'foreign',
        'relation' => 'file',
        'foreign' => 'name',
        'notStorable' => false,
      ),
      'fileId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
    ),
    'relations' => 
    array (
      'folder' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'DocumentFolder',
        'key' => 'folderId',
        'foreignKey' => 'id',
        'foreign' => 'documents',
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Document',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'contacts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Contact',
        'relationName' => 'contactDocument',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'documentId',
          1 => 'contactId',
        ),
        'foreign' => 'documents',
      ),
      'leads' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Lead',
        'relationName' => 'documentLead',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'documentId',
          1 => 'leadId',
        ),
        'foreign' => 'documents',
      ),
      'opportunities' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Opportunity',
        'relationName' => 'documentOpportunity',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'documentId',
          1 => 'opportunityId',
        ),
        'foreign' => 'documents',
      ),
      'accounts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Account',
        'relationName' => 'accountDocument',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'documentId',
          1 => 'accountId',
        ),
        'foreign' => 'documents',
      ),
      'file' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Attachment',
        'key' => 'fileId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'DocumentFolder' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'childList' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'parentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'parentName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'parent',
        'foreign' => 'name',
      ),
      'documentsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'documentsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'childrenIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'childrenNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'documents' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Document',
        'foreignKey' => 'folderId',
        'foreign' => 'folder',
      ),
      'children' => 
      array (
        'type' => 'hasMany',
        'entity' => 'DocumentFolder',
        'foreignKey' => 'parentId',
        'foreign' => 'parent',
      ),
      'parent' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'DocumentFolder',
        'key' => 'parentId',
        'foreignKey' => 'id',
        'foreign' => 'children',
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'DocumentFolder',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'additionalTables' => 
    array (
      'DocumentFolderPath' => 
      array (
        'fields' => 
        array (
          'id' => 
          array (
            'type' => 'id',
            'dbType' => 'int',
            'len' => '11',
            'autoincrement' => true,
            'unique' => true,
          ),
          'ascendorId' => 
          array (
            'type' => 'varchar',
            'len' => '100',
            'index' => true,
          ),
          'descendorId' => 
          array (
            'type' => 'varchar',
            'len' => '24',
            'index' => true,
          ),
        ),
      ),
    ),
  ),
  'EmailQueueItem' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'attemptCount' => 
      array (
        'type' => 'int',
        'default' => '0',
        'len' => 11,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'sentAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'emailAddress' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'isTest' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'massEmailId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'massEmailName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'massEmail',
        'foreign' => 'name',
      ),
      'targetId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'target',
        'notNull' => false,
      ),
      'targetType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'target',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'targetName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'target' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'targetId',
      ),
      'massEmail' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'MassEmail',
        'key' => 'massEmailId',
        'foreignKey' => 'id',
        'foreign' => 'queueItems',
      ),
    ),
  ),
  'KnowledgeBaseArticle' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'default' => 'Draft',
        'len' => 255,
      ),
      'language' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'type' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'publishDate' => 
      array (
        'type' => 'date',
        'notNull' => false,
      ),
      'expirationDate' => 
      array (
        'type' => 'date',
        'notNull' => false,
      ),
      'order' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'body' => 
      array (
        'type' => 'text',
      ),
      'portalsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'portalsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'categoriesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'categoriesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'casesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'casesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsTypes' => 
      array (
        'type' => 'jsonObject',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'categories' => 
      array (
        'type' => 'manyMany',
        'entity' => 'KnowledgeBaseCategory',
        'relationName' => 'knowledgeBaseArticleKnowledgeBaseCategory',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'knowledgeBaseArticleId',
          1 => 'knowledgeBaseCategoryId',
        ),
        'foreign' => 'articles',
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'KnowledgeBaseArticle',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'portals' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Portal',
        'relationName' => 'knowledgeBaseArticlePortal',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'knowledgeBaseArticleId',
          1 => 'portalId',
        ),
        'foreign' => 'articles',
      ),
      'cases' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Case',
        'relationName' => 'caseKnowledgeBaseArticle',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'knowledgeBaseArticleId',
          1 => 'caseId',
        ),
        'foreign' => 'articles',
      ),
      'attachments' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Attachment',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
    ),
  ),
  'KnowledgeBaseCategory' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'order' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'childList' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'parentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'parentName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'parent',
        'foreign' => 'name',
      ),
      'articlesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'articlesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'childrenIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'childrenNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'articles' => 
      array (
        'type' => 'manyMany',
        'entity' => 'KnowledgeBaseArticle',
        'relationName' => 'knowledgeBaseArticleKnowledgeBaseCategory',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'knowledgeBaseCategoryId',
          1 => 'knowledgeBaseArticleId',
        ),
        'foreign' => 'categories',
      ),
      'children' => 
      array (
        'type' => 'hasMany',
        'entity' => 'KnowledgeBaseCategory',
        'foreignKey' => 'parentId',
        'foreign' => 'parent',
      ),
      'parent' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'KnowledgeBaseCategory',
        'key' => 'parentId',
        'foreignKey' => 'id',
        'foreign' => 'children',
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'KnowledgeBaseCategory',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'additionalTables' => 
    array (
      'KnowledgeBaseCategoryPath' => 
      array (
        'fields' => 
        array (
          'id' => 
          array (
            'type' => 'id',
            'dbType' => 'int',
            'len' => '11',
            'autoincrement' => true,
            'unique' => true,
          ),
          'ascendorId' => 
          array (
            'type' => 'varchar',
            'len' => '100',
            'index' => true,
          ),
          'descendorId' => 
          array (
            'type' => 'varchar',
            'len' => '24',
            'index' => true,
          ),
        ),
      ),
    ),
  ),
  'Lead' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'select' => 'TRIM(CONCAT(IFNULL(lead.first_name, \'\'), \' \', IFNULL(lead.last_name, \'\')))',
        'where' => 
        array (
          'LIKE' => '(lead.first_name LIKE {value} OR lead.last_name LIKE {value} OR CONCAT(lead.first_name, \' \', lead.last_name) LIKE {value} OR CONCAT(lead.last_name, \' \', lead.first_name) LIKE {value})',
          '=' => '(lead.first_name = {value} OR lead.last_name = {value} OR CONCAT(lead.first_name, \' \', lead.last_name) = {value} OR CONCAT(lead.last_name, \' \', lead.first_name) = {value})',
        ),
        'orderBy' => 'lead.first_name {direction}',
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'salutationName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'firstName' => 
      array (
        'type' => 'varchar',
        'len' => 100,
        'default' => '',
      ),
      'lastName' => 
      array (
        'type' => 'varchar',
        'len' => 100,
        'default' => '',
      ),
      'title' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'default' => 'New',
        'len' => 255,
      ),
      'source' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'industry' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'opportunityAmount' => 
      array (
        'type' => 'float',
        'orderBy' => 'opportunityAmountConverted {direction}',
      ),
      'website' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressStreet' => 
      array (
        'type' => 'text',
        'dbType' => 'varchar',
        'len' => 255,
      ),
      'addressCity' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressState' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressCountry' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressPostalCode' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'emailAddress' => 
      array (
        'type' => 'email',
        'notStorable' => true,
        'select' => 'emailAddresses.name',
        'where' => 
        array (
          'LIKE' => 'lead.id IN (
                                SELECT entity_id
                                FROM entity_email_address
                                JOIN email_address ON email_address.id = entity_email_address.email_address_id
                                WHERE
                                    entity_email_address.deleted = 0 AND entity_email_address.entity_type = \'Lead\' AND
                                    email_address.deleted = 0 AND email_address.name LIKE {value}
                            )',
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name <> {value}',
            'distinct' => true,
          ),
          'IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IN {value}',
            'distinct' => true,
          ),
          'NOT IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name NOT IN {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IS NOT NULL',
            'distinct' => true,
          ),
        ),
        'orderBy' => 'emailAddresses.name {direction}',
      ),
      'phoneNumber' => 
      array (
        'type' => 'phone',
        'notStorable' => true,
        'select' => 'phoneNumbers.name',
        'where' => 
        array (
          'LIKE' => 'lead.id IN (
                                SELECT entity_id
                                FROM entity_phone_number
                                JOIN phone_number ON phone_number.id = entity_phone_number.phone_number_id
                                WHERE
                                    entity_phone_number.deleted = 0 AND entity_phone_number.entity_type = \'Lead\' AND
                                    phone_number.deleted = 0 AND phone_number.name LIKE {value}
                            )',
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name <> {value}',
            'distinct' => true,
          ),
          'IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IN {value}',
            'distinct' => true,
          ),
          'NOT IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name NOT IN {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IS NOT NULL',
            'distinct' => true,
          ),
        ),
        'orderBy' => 'phoneNumbers.name {direction}',
      ),
      'doNotCall' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'accountName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'acceptanceStatus' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'opportunityAmountCurrency' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressMap' => 
      array (
        'type' => 'map',
        'notStorable' => true,
      ),
      'opportunityAmountConverted' => 
      array (
        'type' => 'float',
        'select' => 'lead.opportunity_amount * opportunity_amount_currency_alias.rate',
        'where' => 
        array (
          '=' => 'lead.opportunity_amount * opportunity_amount_currency_alias.rate = {value}',
          '>' => 'lead.opportunity_amount * opportunity_amount_currency_alias.rate > {value}',
          '<' => 'lead.opportunity_amount * opportunity_amount_currency_alias.rate < {value}',
          '>=' => 'lead.opportunity_amount * opportunity_amount_currency_alias.rate >= {value}',
          '<=' => 'lead.opportunity_amount * opportunity_amount_currency_alias.rate <= {value}',
          '<>' => 'lead.opportunity_amount * opportunity_amount_currency_alias.rate <> {value}',
          'IS NULL' => 'lead.opportunity_amount IS NULL',
          'IS NOT NULL' => 'lead.opportunity_amount IS NOT NULL',
        ),
        'notStorable' => true,
        'orderBy' => 'opportunityAmountConverted {direction}',
      ),
      'emailAddressData' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'phoneNumberData' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'campaignName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'relation' => 'campaign',
        'foreign' => 'name',
      ),
      'createdAccountId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdAccountName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'relation' => 'createdAccount',
        'foreign' => 'name',
      ),
      'createdContactId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdContactName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'relation' => 'createdContact',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'createdOpportunityId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdOpportunityName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'relation' => 'createdOpportunity',
        'foreign' => 'name',
      ),
      'targetListsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'targetList',
        'notStorable' => true,
        'notNull' => false,
      ),
      'targetListName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'isFollowed' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'followersIds' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'followersNames' => 
      array (
        'type' => 'jsonObject',
        'notStorable' => true,
      ),
      'documentsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'documentsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignLogRecordsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignLogRecordsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'casesIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'casesNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'emailAddresses' => 
      array (
        'type' => 'manyMany',
        'entity' => 'EmailAddress',
        'relationName' => 'entityEmailAddress',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'email_address_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Lead',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
          'primary' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
        ),
      ),
      'phoneNumbers' => 
      array (
        'type' => 'manyMany',
        'entity' => 'PhoneNumber',
        'relationName' => 'entityPhoneNumber',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'phone_number_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Lead',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
          'primary' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
        ),
      ),
      'documents' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Document',
        'relationName' => 'documentLead',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'leadId',
          1 => 'documentId',
        ),
        'foreign' => 'leads',
      ),
      'targetLists' => 
      array (
        'type' => 'manyMany',
        'entity' => 'TargetList',
        'relationName' => 'leadTargetList',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'leadId',
          1 => 'targetListId',
        ),
        'foreign' => 'leads',
        'additionalColumns' => 
        array (
          'optedOut' => 
          array (
            'type' => 'bool',
          ),
        ),
      ),
      'campaignLogRecords' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'CampaignLogRecord',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'campaign' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Campaign',
        'key' => 'campaignId',
        'foreignKey' => 'id',
        'foreign' => 'leads',
        'noJoin' => true,
      ),
      'createdOpportunity' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Opportunity',
        'key' => 'createdOpportunityId',
        'foreignKey' => 'id',
        'foreign' => 'originalLead',
        'noJoin' => true,
      ),
      'createdContact' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Contact',
        'key' => 'createdContactId',
        'foreignKey' => 'id',
        'foreign' => 'originalLead',
        'noJoin' => true,
      ),
      'createdAccount' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Account',
        'key' => 'createdAccountId',
        'foreignKey' => 'id',
        'foreign' => 'originalLead',
        'noJoin' => true,
      ),
      'emails' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Email',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'cases' => 
      array (
        'type' => 'hasMany',
        'entity' => 'Case',
        'foreignKey' => 'leadId',
        'foreign' => 'lead',
      ),
      'tasks' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Task',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'calls' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Call',
        'relationName' => 'callLead',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'leadId',
          1 => 'callId',
        ),
        'foreign' => 'leads',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'meetings' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Meeting',
        'relationName' => 'leadMeeting',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'leadId',
          1 => 'meetingId',
        ),
        'foreign' => 'leads',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Lead',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'firstName' => 
      array (
        'columns' => 
        array (
          0 => 'firstName',
          1 => 'deleted',
        ),
      ),
      'name' => 
      array (
        'columns' => 
        array (
          0 => 'firstName',
          1 => 'lastName',
        ),
      ),
      'status' => 
      array (
        'columns' => 
        array (
          0 => 'status',
          1 => 'deleted',
        ),
      ),
      'createdAt' => 
      array (
        'columns' => 
        array (
          0 => 'createdAt',
          1 => 'deleted',
        ),
      ),
      'createdAtStatus' => 
      array (
        'columns' => 
        array (
          0 => 'createdAt',
          1 => 'status',
        ),
      ),
      'assignedUser' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'deleted',
        ),
      ),
      'assignedUserStatus' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'status',
        ),
      ),
    ),
  ),
  'MassEmail' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'default' => 'Pending',
        'len' => 255,
      ),
      'storeSentEmails' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'optOutEntirely' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'fromAddress' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'fromName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'replyToAddress' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'replyToName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'startAt' => 
      array (
        'type' => 'datetime',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'emailTemplateId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'emailTemplateName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'emailTemplate',
        'foreign' => 'name',
      ),
      'campaignId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'campaignName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'campaign',
        'foreign' => 'name',
      ),
      'targetListsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'targetListsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'excludingTargetListsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'excludingTargetListsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'inboundEmailId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'inboundEmailName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'inboundEmail',
        'foreign' => 'name',
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'queueItemsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'queueItemsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'queueItems' => 
      array (
        'type' => 'hasMany',
        'entity' => 'EmailQueueItem',
        'foreignKey' => 'massEmailId',
        'foreign' => 'massEmail',
      ),
      'inboundEmail' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'InboundEmail',
        'key' => 'inboundEmailId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'excludingTargetLists' => 
      array (
        'type' => 'manyMany',
        'entity' => 'TargetList',
        'relationName' => 'massEmailTargetListExcluding',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'massEmailId',
          1 => 'targetListId',
        ),
        'foreign' => 'massEmailsExcluding',
      ),
      'targetLists' => 
      array (
        'type' => 'manyMany',
        'entity' => 'TargetList',
        'relationName' => 'massEmailTargetList',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'massEmailId',
          1 => 'targetListId',
        ),
        'foreign' => 'massEmails',
      ),
      'campaign' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Campaign',
        'key' => 'campaignId',
        'foreignKey' => 'id',
        'foreign' => 'massEmails',
      ),
      'emailTemplate' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'EmailTemplate',
        'key' => 'emailTemplateId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
  ),
  'Meeting' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'default' => 'Planned',
        'len' => 255,
      ),
      'dateStart' => 
      array (
        'type' => 'datetime',
      ),
      'dateEnd' => 
      array (
        'type' => 'datetime',
      ),
      'duration' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'default' => '3600',
        'select' => 'TIMESTAMPDIFF(SECOND, date_start, date_end)',
        'orderBy' => 'duration {direction}',
        'len' => 11,
      ),
      'reminders' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'acceptanceStatus' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'len' => 255,
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'parentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'parent',
        'notNull' => false,
      ),
      'parentType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'parent',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'parentName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'accountName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'account',
        'foreign' => 'name',
      ),
      'usersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersColumns' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsColumns' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsColumns' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'parent' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'parentId',
      ),
      'leads' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Lead',
        'relationName' => 'leadMeeting',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'meetingId',
          1 => 'leadId',
        ),
        'foreign' => 'meetings',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'contacts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Contact',
        'relationName' => 'contactMeeting',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'meetingId',
          1 => 'contactId',
        ),
        'foreign' => 'meetings',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'users' => 
      array (
        'type' => 'manyMany',
        'entity' => 'User',
        'relationName' => 'meetingUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'meetingId',
          1 => 'userId',
        ),
        'foreign' => 'meetings',
        'additionalColumns' => 
        array (
          'status' => 
          array (
            'type' => 'varchar',
            'len' => '36',
            'default' => 'None',
          ),
        ),
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Meeting',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'account' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Account',
        'key' => 'accountId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'dateStartStatus' => 
      array (
        'columns' => 
        array (
          0 => 'dateStart',
          1 => 'status',
        ),
      ),
      'dateStart' => 
      array (
        'columns' => 
        array (
          0 => 'dateStart',
          1 => 'deleted',
        ),
      ),
      'status' => 
      array (
        'columns' => 
        array (
          0 => 'status',
          1 => 'deleted',
        ),
      ),
      'assignedUser' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'deleted',
        ),
      ),
      'assignedUserStatus' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'status',
        ),
      ),
    ),
  ),
  'Opportunity' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'amount' => 
      array (
        'type' => 'float',
        'orderBy' => 'amountConverted {direction}',
      ),
      'amountWeightedConverted' => 
      array (
        'type' => 'float',
        'notNull' => false,
        'notStorable' => true,
        'select' => 'opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100',
        'orderBy' => 'amountWeightedConverted {direction}',
        'where' => 
        array (
          '=' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) = {value}',
          '<' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) < {value}',
          '>' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) > {value}',
          '<=' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) <= {value}',
          '>=' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) >= {value}',
          '<>' => '(opportunity.amount * amount_currency_alias.rate * opportunity.probability / 100) <> {value}',
        ),
      ),
      'stage' => 
      array (
        'type' => 'varchar',
        'default' => 'Prospecting',
        'len' => 255,
      ),
      'probability' => 
      array (
        'type' => 'int',
        'len' => 11,
      ),
      'leadSource' => 
      array (
        'type' => 'varchar',
        'default' => '',
        'len' => 255,
      ),
      'closeDate' => 
      array (
        'type' => 'date',
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'amountCurrency' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'amountConverted' => 
      array (
        'type' => 'float',
        'select' => 'opportunity.amount * amount_currency_alias.rate',
        'where' => 
        array (
          '=' => 'opportunity.amount * amount_currency_alias.rate = {value}',
          '>' => 'opportunity.amount * amount_currency_alias.rate > {value}',
          '<' => 'opportunity.amount * amount_currency_alias.rate < {value}',
          '>=' => 'opportunity.amount * amount_currency_alias.rate >= {value}',
          '<=' => 'opportunity.amount * amount_currency_alias.rate <= {value}',
          '<>' => 'opportunity.amount * amount_currency_alias.rate <> {value}',
          'IS NULL' => 'opportunity.amount IS NULL',
          'IS NOT NULL' => 'opportunity.amount IS NOT NULL',
        ),
        'notStorable' => true,
        'orderBy' => 'amountConverted {direction}',
      ),
      'accountId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'accountName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'account',
        'foreign' => 'name',
      ),
      'contactsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsColumns' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'campaignName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'relation' => 'campaign',
        'foreign' => 'name',
      ),
      'originalLeadId' => 
      array (
        'type' => 'varchar',
        'index' => 'originalLead',
        'notStorable' => true,
      ),
      'originalLeadName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'isFollowed' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'followersIds' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'followersNames' => 
      array (
        'type' => 'jsonObject',
        'notStorable' => true,
      ),
      'documentsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'documentsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'emailsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'tasksNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'callsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'meetingsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'originalLead' => 
      array (
        'type' => 'hasOne',
        'entity' => 'Lead',
        'foreignKey' => 'createdOpportunityId',
        'foreign' => 'createdOpportunity',
        'noJoin' => true,
      ),
      'campaign' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Campaign',
        'key' => 'campaignId',
        'foreignKey' => 'id',
        'foreign' => 'opportunities',
        'noJoin' => true,
      ),
      'documents' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Document',
        'relationName' => 'documentOpportunity',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'opportunityId',
          1 => 'documentId',
        ),
        'foreign' => 'opportunities',
      ),
      'emails' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Email',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'tasks' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Task',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'calls' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Call',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'meetings' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Meeting',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
      'contacts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Contact',
        'relationName' => 'contactOpportunity',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'opportunityId',
          1 => 'contactId',
        ),
        'foreign' => 'opportunities',
        'additionalColumns' => 
        array (
          'role' => 
          array (
            'type' => 'varchar',
            'len' => 50,
          ),
        ),
      ),
      'account' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Account',
        'key' => 'accountId',
        'foreignKey' => 'id',
        'foreign' => 'opportunities',
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Opportunity',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'stage' => 
      array (
        'columns' => 
        array (
          0 => 'stage',
          1 => 'deleted',
        ),
      ),
      'assignedUser' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'deleted',
        ),
      ),
      'createdAt' => 
      array (
        'columns' => 
        array (
          0 => 'createdAt',
          1 => 'deleted',
        ),
      ),
      'createdAtStage' => 
      array (
        'columns' => 
        array (
          0 => 'createdAt',
          1 => 'stage',
        ),
      ),
      'assignedUserStage' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'stage',
        ),
      ),
    ),
  ),
  'Reminder' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'remindAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
        'index' => true,
      ),
      'startAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
        'index' => true,
      ),
      'type' => 
      array (
        'type' => 'varchar',
        'len' => 36,
        'index' => true,
        'default' => 'Popup',
      ),
      'seconds' => 
      array (
        'type' => 'int',
        'default' => '0',
        'len' => 11,
      ),
      'entityType' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'entityId' => 
      array (
        'type' => 'varchar',
        'len' => 50,
      ),
      'userId' => 
      array (
        'type' => 'varchar',
        'len' => 50,
      ),
    ),
    'relations' => 
    array (
    ),
  ),
  'Target' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
        'select' => 'TRIM(CONCAT(IFNULL(target.first_name, \'\'), \' \', IFNULL(target.last_name, \'\')))',
        'where' => 
        array (
          'LIKE' => '(target.first_name LIKE {value} OR target.last_name LIKE {value} OR CONCAT(target.first_name, \' \', target.last_name) LIKE {value} OR CONCAT(target.last_name, \' \', target.first_name) LIKE {value})',
          '=' => '(target.first_name = {value} OR target.last_name = {value} OR CONCAT(target.first_name, \' \', target.last_name) = {value} OR CONCAT(target.last_name, \' \', target.first_name) = {value})',
        ),
        'orderBy' => 'target.first_name {direction}',
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'salutationName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'firstName' => 
      array (
        'type' => 'varchar',
        'len' => 100,
        'default' => '',
      ),
      'lastName' => 
      array (
        'type' => 'varchar',
        'len' => 100,
        'default' => '',
      ),
      'title' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'accountName' => 
      array (
        'type' => 'varchar',
        'len' => 100,
      ),
      'website' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressStreet' => 
      array (
        'type' => 'text',
        'dbType' => 'varchar',
        'len' => 255,
      ),
      'addressCity' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressState' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressCountry' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'addressPostalCode' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'emailAddress' => 
      array (
        'type' => 'email',
        'notStorable' => true,
        'select' => 'emailAddresses.name',
        'where' => 
        array (
          'LIKE' => 'target.id IN (
                                SELECT entity_id
                                FROM entity_email_address
                                JOIN email_address ON email_address.id = entity_email_address.email_address_id
                                WHERE
                                    entity_email_address.deleted = 0 AND entity_email_address.entity_type = \'Target\' AND
                                    email_address.deleted = 0 AND email_address.name LIKE {value}
                            )',
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name <> {value}',
            'distinct' => true,
          ),
          'IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IN {value}',
            'distinct' => true,
          ),
          'NOT IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name NOT IN {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'emailAddresses',
                1 => 'emailAddressesMultiple',
              ),
            ),
            'sql' => 'emailAddressesMultiple.name IS NOT NULL',
            'distinct' => true,
          ),
        ),
        'orderBy' => 'emailAddresses.name {direction}',
      ),
      'phoneNumber' => 
      array (
        'type' => 'phone',
        'notStorable' => true,
        'select' => 'phoneNumbers.name',
        'where' => 
        array (
          'LIKE' => 'target.id IN (
                                SELECT entity_id
                                FROM entity_phone_number
                                JOIN phone_number ON phone_number.id = entity_phone_number.phone_number_id
                                WHERE
                                    entity_phone_number.deleted = 0 AND entity_phone_number.entity_type = \'Target\' AND
                                    phone_number.deleted = 0 AND phone_number.name LIKE {value}
                            )',
          '=' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name = {value}',
            'distinct' => true,
          ),
          '<>' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name <> {value}',
            'distinct' => true,
          ),
          'IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IN {value}',
            'distinct' => true,
          ),
          'NOT IN' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name NOT IN {value}',
            'distinct' => true,
          ),
          'IS NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IS NULL',
            'distinct' => true,
          ),
          'IS NOT NULL' => 
          array (
            'leftJoins' => 
            array (
              0 => 
              array (
                0 => 'phoneNumbers',
                1 => 'phoneNumbersMultiple',
              ),
            ),
            'sql' => 'phoneNumbersMultiple.name IS NOT NULL',
            'distinct' => true,
          ),
        ),
        'orderBy' => 'phoneNumbers.name {direction}',
      ),
      'doNotCall' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'default' => false,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'addressMap' => 
      array (
        'type' => 'map',
        'notStorable' => true,
      ),
      'emailAddressData' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'phoneNumberData' => 
      array (
        'type' => 'text',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'emailAddresses' => 
      array (
        'type' => 'manyMany',
        'entity' => 'EmailAddress',
        'relationName' => 'entityEmailAddress',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'email_address_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Target',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
          'primary' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
        ),
      ),
      'phoneNumbers' => 
      array (
        'type' => 'manyMany',
        'entity' => 'PhoneNumber',
        'relationName' => 'entityPhoneNumber',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'phone_number_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Target',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
          'primary' => 
          array (
            'type' => 'bool',
            'default' => false,
          ),
        ),
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Target',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'firstName' => 
      array (
        'columns' => 
        array (
          0 => 'firstName',
          1 => 'deleted',
        ),
      ),
      'name' => 
      array (
        'columns' => 
        array (
          0 => 'firstName',
          1 => 'lastName',
        ),
      ),
      'assignedUser' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'deleted',
        ),
      ),
    ),
  ),
  'TargetList' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'entryCount' => 
      array (
        'type' => 'int',
        'notStorable' => true,
        'len' => 11,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'includingActionList' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'excludingActionList' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignsId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'campaigns',
        'notNull' => false,
      ),
      'campaignsName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'usersNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'leadsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'contactsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'massEmailsExcludingIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'massEmailsExcludingNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignsExcludingIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignsExcludingNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'massEmailsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'massEmailsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'campaignsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'users' => 
      array (
        'type' => 'manyMany',
        'entity' => 'User',
        'relationName' => 'targetListUser',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'targetListId',
          1 => 'userId',
        ),
        'foreign' => 'targetLists',
        'additionalColumns' => 
        array (
          'optedOut' => 
          array (
            'type' => 'bool',
          ),
        ),
      ),
      'leads' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Lead',
        'relationName' => 'leadTargetList',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'targetListId',
          1 => 'leadId',
        ),
        'foreign' => 'targetLists',
        'additionalColumns' => 
        array (
          'optedOut' => 
          array (
            'type' => 'bool',
          ),
        ),
      ),
      'contacts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Contact',
        'relationName' => 'contactTargetList',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'targetListId',
          1 => 'contactId',
        ),
        'foreign' => 'targetLists',
        'additionalColumns' => 
        array (
          'optedOut' => 
          array (
            'type' => 'bool',
          ),
        ),
      ),
      'accounts' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Account',
        'relationName' => 'accountTargetList',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'targetListId',
          1 => 'accountId',
        ),
        'foreign' => 'targetLists',
        'additionalColumns' => 
        array (
          'optedOut' => 
          array (
            'type' => 'bool',
          ),
        ),
      ),
      'massEmailsExcluding' => 
      array (
        'type' => 'manyMany',
        'entity' => 'MassEmail',
        'relationName' => 'massEmailTargetListExcluding',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'targetListId',
          1 => 'massEmailId',
        ),
        'foreign' => 'excludingTargetLists',
      ),
      'campaignsExcluding' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Campaign',
        'relationName' => 'campaignTargetListExcluding',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'targetListId',
          1 => 'campaignId',
        ),
        'foreign' => 'excludingTargetLists',
      ),
      'massEmails' => 
      array (
        'type' => 'manyMany',
        'entity' => 'MassEmail',
        'relationName' => 'massEmailTargetList',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'targetListId',
          1 => 'massEmailId',
        ),
        'foreign' => 'targetLists',
      ),
      'campaigns' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Campaign',
        'relationName' => 'campaignTargetList',
        'key' => 'id',
        'foreignKey' => 'id',
        'midKeys' => 
        array (
          0 => 'targetListId',
          1 => 'campaignId',
        ),
        'foreign' => 'targetLists',
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'TargetList',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
    ),
    'indexes' => 
    array (
      'createdAt' => 
      array (
        'columns' => 
        array (
          0 => 'createdAt',
          1 => 'deleted',
        ),
      ),
    ),
  ),
  'Task' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'default' => 'Not Started',
        'len' => 255,
      ),
      'priority' => 
      array (
        'type' => 'varchar',
        'default' => 'Normal',
        'len' => 255,
      ),
      'dateStart' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'dateEnd' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'dateStartDate' => 
      array (
        'type' => 'date',
        'notNull' => false,
      ),
      'dateEndDate' => 
      array (
        'type' => 'date',
        'notNull' => false,
      ),
      'dateCompleted' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'isOverdue' => 
      array (
        'type' => 'bool',
        'notNull' => true,
        'notStorable' => true,
        'default' => false,
      ),
      'reminders' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'description' => 
      array (
        'type' => 'text',
      ),
      'createdAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'modifiedAt' => 
      array (
        'type' => 'datetime',
        'notNull' => false,
      ),
      'parentId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => 'parent',
        'notNull' => false,
      ),
      'parentType' => 
      array (
        'type' => 'foreignType',
        'notNull' => false,
        'index' => 'parent',
        'len' => 100,
        'dbType' => 'varchar',
      ),
      'parentName' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'accountId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'accountName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'account',
        'foreign' => 'name',
      ),
      'createdById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'createdByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'createdBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'modifiedById' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'modifiedByName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'modifiedBy',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'assignedUserId' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'foreignId',
        'index' => true,
        'notNull' => false,
      ),
      'assignedUserName' => 
      array (
        'type' => 'foreign',
        'notStorable' => false,
        'relation' => 'assignedUser',
        'foreign' => 
        array (
          0 => 'firstName',
          1 => ' ',
          2 => 'lastName',
        ),
      ),
      'teamsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'teamsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsIds' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsNames' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'attachmentsTypes' => 
      array (
        'type' => 'jsonObject',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
      'account' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'Account',
        'key' => 'accountId',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'parent' => 
      array (
        'type' => 'belongsToParent',
        'key' => 'parentId',
      ),
      'teams' => 
      array (
        'type' => 'manyMany',
        'entity' => 'Team',
        'relationName' => 'entityTeam',
        'midKeys' => 
        array (
          0 => 'entity_id',
          1 => 'team_id',
        ),
        'conditions' => 
        array (
          'entityType' => 'Task',
        ),
        'additionalColumns' => 
        array (
          'entityType' => 
          array (
            'type' => 'varchar',
            'len' => 100,
          ),
        ),
      ),
      'assignedUser' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'assignedUserId',
        'foreignKey' => 'id',
        'foreign' => 'tasks',
      ),
      'modifiedBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'modifiedById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'createdBy' => 
      array (
        'type' => 'belongsTo',
        'entity' => 'User',
        'key' => 'createdById',
        'foreignKey' => 'id',
        'foreign' => NULL,
      ),
      'attachments' => 
      array (
        'type' => 'hasChildren',
        'entity' => 'Attachment',
        'foreignKey' => 'parentId',
        'foreignType' => 'parentType',
        'foreign' => 'parent',
      ),
    ),
    'indexes' => 
    array (
      'dateStartStatus' => 
      array (
        'columns' => 
        array (
          0 => 'dateStart',
          1 => 'status',
        ),
      ),
      'dateEndStatus' => 
      array (
        'columns' => 
        array (
          0 => 'dateEnd',
          1 => 'status',
        ),
      ),
      'dateStart' => 
      array (
        'columns' => 
        array (
          0 => 'dateStart',
          1 => 'deleted',
        ),
      ),
      'status' => 
      array (
        'columns' => 
        array (
          0 => 'status',
          1 => 'deleted',
        ),
      ),
      'assignedUser' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'deleted',
        ),
      ),
      'assignedUserStatus' => 
      array (
        'columns' => 
        array (
          0 => 'assignedUserId',
          1 => 'status',
        ),
      ),
    ),
  ),
  'Smail' => 
  array (
    'fields' => 
    array (
      'id' => 
      array (
        'dbType' => 'varchar',
        'len' => 24,
        'type' => 'id',
      ),
      'name' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'deleted' => 
      array (
        'type' => 'bool',
        'default' => false,
      ),
      'fromName' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'toAddress' => 
      array (
        'type' => 'varchar',
        'len' => 255,
      ),
      'subject' => 
      array (
        'type' => 'text',
      ),
      'text' => 
      array (
        'type' => 'text',
      ),
      'isFollowed' => 
      array (
        'type' => 'varchar',
        'notStorable' => true,
      ),
      'followersIds' => 
      array (
        'type' => 'jsonArray',
        'notStorable' => true,
      ),
      'followersNames' => 
      array (
        'type' => 'jsonObject',
        'notStorable' => true,
      ),
    ),
    'relations' => 
    array (
    ),
  ),
);
?>