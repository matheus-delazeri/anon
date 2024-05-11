import { $Enums, UserGroup, PrismaClient } from "@prisma/client";

import { UserGroupRepository } from "../repositories/userGroup";
import { UserRepository } from "../repositories/user";
import { GroupRepository } from "../repositories/group";


export class UserGroupService {
    private userGroupRepository: UserGroupRepository;
    private userRepository: UserRepository;
    private groupRepository: GroupRepository;

    constructor(prisma: PrismaClient){
        this.userGroupRepository = new UserGroupRepository(prisma);
        this.userRepository = new UserRepository(prisma);
        this.groupRepository = new GroupRepository(prisma);
    }

    //Search
    async getUserGroup(userId: number, groupId: number): Promise<UserGroup | null>{
        await this.testUserId(userId);
        await this.testGroupId(groupId);
    
        return this.userGroupRepository.getUserGroup(userId, groupId);
    }

    async getUsersFromGroup(groupId: number): Promise<UserGroup[] | null>{
        await this.testGroupId(groupId);

        return this.userGroupRepository.getUsersFromGroup(groupId);
    }

    async getGroupsOfUser(userId: number): Promise<UserGroup[] | null>{
        await this.testUserId(userId);

        return this.userGroupRepository.getGroupsOfUser(userId);
    }

    //Manipulation
    async addUserToGroup(requesterId: number, userId: number, groupId: number, role: string): Promise<UserGroup>{
        await this.testUserId(userId);
        await this.testGroupId(groupId);
        await this.testUserId(requesterId);
        await this.testRequesterAdminRole(requesterId, groupId);

        return this.userGroupRepository.addUserToGroup(userId, groupId, this.stringToRole(role));
    }

    async updateRole(requesterId: number,userId: number, groupId: number, role: string): Promise<UserGroup | null>{
        await this.testUserId(userId);
        await this.testGroupId(groupId);
        await this.testUserId(requesterId);
        await this.testRequesterAdminRole(requesterId, groupId);

        return this.userGroupRepository.updateRole(userId, groupId, this.stringToRole(role));
    }

    async deleteUserFromGroup(requesterId: number,userId: number, groupId: number): Promise<Boolean>{
        await this.testUserId(userId);
        await this.testGroupId(groupId);
        await this.testUserId(requesterId);
        await this.testRequesterAdminRole(requesterId, groupId);

        return this.userGroupRepository.deleteUserFromGroup(userId, groupId);
    }

    //Conversion of a string role for a Role role
    private stringToRole(role: string): $Enums.Role{
        switch (role) {   
            case 'N':
                return $Enums.Role.NORMAL;  
            case 'A':
                return $Enums.Role.ADMIN;
            case 'M':
                return $Enums.Role.MODERATOR; 
            default:
                throw new Error("Invalid role");
        }
    }

    //Tests

    //Tests if the user exists in the database
    private async testUserId(userId: number) {
        if (userId){
            const userExists = await this.userRepository.exists(userId);
        
            if (!userExists) {
                throw new Error('User does not exist in the database');
            }
        }
        else{
            throw new Error('Invalid user id');
        }
    }

    //Tests if the group exists in the database
    private async testGroupId(groupId: number) {
        if (groupId){
            const groupExists = await this.groupRepository.exists(groupId);
        
            if (!groupExists) {
                throw new Error('Group does not exist in the database');
            }
        }
        else{
            throw new Error('Invalid group id');
        }
    }

    //Tests if the requester is an admin
    private async testRequesterAdminRole(requesterId: number, groupId: number) {
        const requester = await this.getUserGroup(requesterId, groupId);

        if (!requester){
            throw new Error("Invalid requester");
        }
        else{
            if(requester.role != $Enums.Role.ADMIN){
                throw new Error("Access denied");
            }
        }
    }
}