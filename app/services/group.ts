import { GroupRepository } from "../repositories/group";
import { UserRepository } from "../repositories/user";

import { prisma } from "../prisma";
import { Group } from "@prisma/client";

export class GroupService {
    private groupRepository: GroupRepository;

    constructor(groupRepository: GroupRepository) {
        this.groupRepository = groupRepository;
    }

    async createGroup(adminId: number, groupName: string): Promise<Group>{
        const userRepository = new UserRepository(prisma);
        const master = await userRepository.getUserById(adminId);

        if(!master){
            throw new Error("Group master not found!");
        }

        return this.groupRepository.createGroup(master.id, groupName);
    }

    async updateGroup(adminId: number, groupId: number, newName: string, newModeratorId: number): Promise<Group | null>{
        const group = await this.permissionCheck(adminId, groupId);

        //Tests if the parse was succesful
        if (!(isNaN(adminId) || isNaN(groupId) || isNaN(newModeratorId))){
            throw new Error("Some id's are not numbers!");
        }
        
        //If the moderator was not inserted (id smaller than 0) sets the aux variable to null (not inserted) 
        let auxModeratorId: number | null = newModeratorId;
        if (auxModeratorId <= 0){
            auxModeratorId = null;
        } 
        else {
            //Tests if the moderator was altered
            if (auxModeratorId !== group.moderatorId){
                //Searchs if the moderator exists in the database
                const userRepository = new UserRepository(prisma);
                const moderator = await userRepository.getUserById(auxModeratorId);

                //Throw an error if there is no moderator with this id(null)
                if (!moderator){
                    throw new Error("Moderator not found!");
                }
            }
        }

        //Return the updated group or null (error)
        return this.groupRepository.updateGroup(groupId, newName, auxModeratorId);
    }

    async getGroupById(id: number): Promise<Group | null> {
        //Return the requested group or null (was not found/error)
        return this.groupRepository.getGroupById(id);
    }

    async getGroupByName(name: string): Promise<Group[] | null> {
        //Return a array of groups withe the requested name or null (was not found/error)
        return this.groupRepository.getGroupByName(name);
    }

    async deleteGroup(adminId: number,groupId: number): Promise<Boolean> {
        this.permissionCheck(adminId, groupId);

        //
        if (await this.groupRepository.deleteGroup(groupId)){
            return true;
        }
        else{
            return false;
        }
    }
    
    //Checks if the group's master and the received master are the same (Permission)
    private async permissionCheck(userId: number,groupId: number): Promise<Group> {
        const group = await this.groupRepository.getGroupById(groupId);
        const 

        if (!group){
            throw new Error("Group not found");
        }
        else{
            if (group.adminId != adminId){
                throw new Error("Permission Denied!");
            }
        }

        return group;
    }
}