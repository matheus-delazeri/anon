import { GroupRepository } from "../repositories/group";
import { UserRepository } from "../repositories/user";

import { prisma } from "../prisma";
import { Group } from "@prisma/client";

export class GroupService {
    private groupRepository: GroupRepository;

    constructor(groupRepository: GroupRepository) {
        this.groupRepository = groupRepository;
    }

    async createGroup(masterId: number, groupName: string): Promise<Group | boolean>{
        const userRepository = new UserRepository(prisma);
        const master = await userRepository.getUserById(masterId);

        if(!master){
            throw new Error("Group master not found!")
        }

        return this.groupRepository.createGroup(master.id, groupName);
    }

    async updateGroup(masterId: number, groupId: number, newName: string, newModeratorId: number | null): Promise<Group | null>{
        this.permissionCheck(masterId, groupId);

        return this.groupRepository.updateGroup(groupId,newName, newModeratorId);
    }

    async getGroupById(id: number): Promise<Group | null> {
        return this.groupRepository.getGroupById(id);
    }

    async getGroupByName(name: string): Promise<Group[] | null> {
        return this.groupRepository.getGroupByName(name);
    }

    async deleteGroup(masterId: number,groupId: number) {
        this.permissionCheck(masterId, groupId);

        await this.groupRepository.deleteGroup(groupId);
    }
    
    //Checks if the group's master and the received master are the same
    private async permissionCheck(masterId: number,groupId: number) {
        const group = await this.groupRepository.getGroupById(groupId);

        if (!group){
            throw new Error("Group not found");
        }
        else{
            if (group.masterId != masterId){
                throw new Error("Permission Denied!")
            }
        }
    }
}