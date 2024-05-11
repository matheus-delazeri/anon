import { GroupRepository } from "../repositories/group";
import { UserRepository } from "../repositories/user";
import { UserGroupRepository } from "../repositories/userGroup";

import { $Enums, Group, PrismaClient } from "@prisma/client";

export class GroupService {
    private groupRepository: GroupRepository;
    private userRepository: UserRepository;
    private userGroupRepository: UserGroupRepository;

    constructor(prisma: PrismaClient) {
        this.groupRepository = new GroupRepository(prisma);
        this.userRepository = new UserRepository(prisma);
        this.userGroupRepository = new UserGroupRepository(prisma);
    }

    //Search
    async getGroupById(id: number): Promise<Group | null> {
        return this.groupRepository.getGroupById(id);
    }

    async getGroupByName(name: string): Promise<Group[] | null> {
        return this.groupRepository.getGroupByName(name);
    }


    //Manipulation
    async createGroup(requesterId: number, groupName: string): Promise<Group>{
        await this.testUserId(requesterId);

        const group = await this.groupRepository.createGroup(groupName);
        
        //Creates a UserGroup with the requester as the admin
        await this.userGroupRepository.addUserToGroup(requesterId, group.id, $Enums.Role.ADMIN);

        return group;
    }

    async updateGroup(requesterId: number, groupId: number, newName: string): Promise<Group | null>{
        await this.testUserId(requesterId);
        await this.testGroupId(groupId);
        await this.permissionCheck(requesterId, groupId);

        return this.groupRepository.updateGroup(groupId, newName);
    }

    async deleteGroup(requesterId: number,groupId: number): Promise<Boolean> {
        await this.testUserId(requesterId);
        await this.testGroupId(groupId);
        await this.permissionCheck(requesterId, groupId);

        await this.userGroupRepository.deleteAllUsersFromGroup(groupId);

        return await this.groupRepository.deleteGroup(groupId);
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

    //Tests if the requester has the necessary permissions
    private async permissionCheck(requesterId: number, groupId: number){
        const userGroup = await this.userGroupRepository.getUserGroup(requesterId, groupId);

        if (!userGroup){
            throw new Error('User does not belong to the group');
        }

        if (userGroup.role != $Enums.Role.ADMIN){
            throw new Error('User does not have the necessary permissions');
        }
    }
}