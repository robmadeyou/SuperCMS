<?php

namespace SuperCMS\Models\User;

use Rhubarb\Scaffolds\AuthenticationWithRoles\User;
use Rhubarb\Stem\Schema\ModelSchema;

/**
 *
 *
 * @property int $UserID Repository field
 * @property string $Username Repository field
 * @property string $Password Repository field
 * @property string $Forename Repository field
 * @property string $Surname Repository field
 * @property string $Email Repository field
 * @property string $Token Repository field
 * @property \Rhubarb\Crown\DateTime\RhubarbDateTime $TokenExpiry Repository field
 * @property bool $Enabled Repository field
 * @property string $PasswordResetHash Repository field
 * @property \Rhubarb\Crown\DateTime\RhubarbDateTime $PasswordResetDate Repository field
 * @property int $RoleID Repository field
 * @property-read \Rhubarb\Scaffolds\AuthenticationWithRoles\Role $Role Relationship
 * @property-read \Rhubarb\Scaffolds\AuthenticationWithRoles\PermissionAssignment[]|\Rhubarb\Stem\Collections\Collection $Permissions Relationship
 * @property-read \Rhubarb\Scaffolds\AuthenticationWithRoles\UserRole[]|\Rhubarb\Stem\Collections\Collection $RolesRaw Relationship
 * @property-read \Rhubarb\Scaffolds\AuthenticationWithRoles\Role[]|\Rhubarb\Stem\Collections\Collection $Roles Relationship
 */
class CmsUser extends User
{
}
