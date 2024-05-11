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
            throw new Error("Group master not found!");
        }

        return this.groupRepository.createGroup(master.id, groupName);
    }

    async updateGroup(masterId: number, groupId: number, newName: string, newModeratorId: number): Promise<Group | null>{
        const group = await this.permissionCheck(masterId, groupId);

        if (!(isNaN(masterId) || isNaN(groupId) || isNaN(newModeratorId))){
            throw new Error("Some id's are not numbers!");
        }
        
        let auxModeratorId: number | null = newModeratorId;
        if (auxModeratorId <= 0){
            auxModeratorId = null;
        }

        if (auxModeratorId){
            if (auxModeratorId !== group.moderatorId){
                const userRepository = new UserRepository(prisma);
                const moderator = await userRepository.getUserById(auxModeratorId);

                if (!moderator){
                    throw new Error("Moderator not found!");
                }
            }
        }

        return this.groupRepository.updateGroup(groupId, newName, auxModeratorId);
    }

    async getGroupById(id: number): Promise<Group | null> {
        return this.groupRepository.getGroupById(id);
    }

    async getGroupByName(name: string): Promise<Group[] | null> {
        return this.groupRepository.getGroupByName(name);
    }

    async deleteGroup(masterId: number,groupId: number): Promise<Boolean> {
        this.permissionCheck(masterId, groupId);

        if (await this.groupRepository.deleteGroup(groupId)){
            return true;
        }
        else{
            return false;
        }
    }
    
    //Checks if the group's master and the received master are the same (Permission)
    private async permissionCheck(masterId: number,groupId: number): Promise<Group> {
        const group = await this.groupRepository.getGroupById(groupId);

        if (!group){
            throw new Error("Group not found");
        }
        else{
            if (group.masterId != masterId){
                throw new Error("Permission Denied!");
            }
        }

        return group;
    }
}